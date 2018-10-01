<?php 
	session_start();
	
	if($_GET['menu'] == "all"){
		$_SESSION['shop_menu']="*";
	}
	
	$_SESSION['shop_menu']=$_GET['menu'];
	echo $_SESSION['shop_menu'];
	header('Location: ../index.php?page=shop');
?>