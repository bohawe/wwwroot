<?php 
require_once 'vendor/autoload.php';

// Start user session reqd for storing state
session_start(); 

// Your App Configs
$provider = new TheNetworg\OAuth2\Client\Provider\Azure([
    'clientId'          => '23eca1c9-bdb1-45b9-8f6a-51ac29f41129',
    'clientSecret'      => 'xz9zB.ld1v204gA.bD~o4OO_97.Gt-Lam2',
    'redirectUri'       => 'https://www.thedashboardaspire.com/Adminsite'
]);

// Just do basic read of /me endpoint 
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
    // Your App Con
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
        //echo $me;
        // To get individual claims, you can do '$me['userPrincipalName']'
        //$values = '<pre>' . print_r($me, true) . '</pre>';
        //print_r($me);
        $user = '';
        foreach ($me as $key => $value)
        {
            if ($key == 'userPrincipalName')
            {
                $_SESSION['userid'] = $value;
            }
        }
	 
        
        
    } catch (Exception $e) {
        exit('Failed to call the me endpoint of MS Graph.');
    }
    
}