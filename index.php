<?php

	
	if(isset($_GET['page']))
	{
		$url = $_GET['page'];
	}
	else{
		$url = "home";	
	}


	
	
	
	include ("modules/header.php");
	
	include ("pages/". $url .".php");
	
	include ("modules/footer.php");
?>