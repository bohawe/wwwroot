<?php 
    session_start();
    require_once 'vendor/autoload.php';
   	    $provider = new TheNetworg\OAuth2\Client\Provider\Azure([
        'clientId'          => '23eca1c9-bdb1-45b9-8f6a-51ac29f41129',
        'clientSecret'      => 'xz9zB.ld1v204gA.bD~o4OO_97.Gt-Lam2',
        'redirectUri'       => 'https://www.thedashboardaspire.com/Adminsite'
        ]);
    if ($_POST['useraction'] == 'Log Out')
    {
        session_destroy();
         $logout = $provider->getLogoutUrl();
         header('Location: '.$logout);
         exit;
    }
    
    if (isset($_SESSION['userid']))
    {
    	include getcwd().'/apps/lib/config.php';
    	require getcwd().'/apps/lib/application.php';
    	$app = new Application();	
    }
    else
    {
   	    
        $provider->scope = ['offline_access User.Read'];
        $provider->urlAPI = "https://graph.microsoft.com/v1.0/";

        // This tells the library not to pass resource reqd for v2.0
        $provider->authWithResource = false;
        // Obtain the auth code
        if (!isset($_GET['code'])) {
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;
        
        // State validation 
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit("State mismatch, ending auth");
        
        } else {
            // Exchange auth code for tokens
            // Token will be in '$token->getToken();'
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code'],
                'resource' => 'https://graph.microsoft.com',
            ]);
            
            // Now we can call /me endpoint of MS Graph 
            try {
                $me = $provider->get("me", $token);
        
                foreach ($me as $key => $value)
                {
                    if ($key == 'userPrincipalName')
                    {
                        $url = 'https://www.thedashboardaspire.com/Adminsite';
                        $_SESSION['userid'] = $value;
                        header('Location: '.$url);
                        exit;
                    }
                }
        
            } catch (Exception $e) {
                exit('Failed to call the me endpoint of MS Graph.');
            }
}
    }
?>