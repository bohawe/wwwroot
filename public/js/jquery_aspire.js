var bipage = "/apps/control/report_view.php?reportid="+reportid;
$(document).ready(function(){ 		
	var update = function(){
	$('#panel').load(bipage).fadeIn("slow");};	
	update();	
});	

	
