    <script type="text/javascript">
       function hideLoading() {
            document.getElementById('divLoading').style.display = "none";
            document.getElementById('divFrameHolder').style.display = "block";
        }
    </script> 
<?php
	
	$reportpage = "";		 
	$reportid = $_GET['reportid'];
	require_once( $_SERVER['DOCUMENT_ROOT'].'/apps/lib/dblayer/datapipe.php');
	$apidata = new datapipe();				
	$reportpage = $apidata->getreporturl($reportid);	
	if ($reportpage=='dberror') {exit;}
	
	if ($reportpage!=''){
?>
		<div id="divLoading"> 
		<img src="/public/image/loading.gif" alt="" style=" position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);" />
		</div> 
		<div id="divFrameHolder"  style="display:none">
		<iframe allowfullscreen="0" onload="hideLoading()" style="position:absolute;left:0;width:100%;height:100%;background-color:#fff;" frameBorder="0"src="<?php echo $reportpage; ?>" /></iframe>
		</div>

<?php
	}
	?>

