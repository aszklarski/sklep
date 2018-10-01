<?php
	session_start();
	require_once "connect.php";
	
	$mysqli = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($mysqli->connect_errno!=0)
	{
		echo "Error: ".$mysqli->connect_errno;
	}
	if (!$mysqli->query("SELECT * FROM users"))
	{
		echo "Errormessage: %s\n". $mysqli->error;
	}
	else 
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		

		
		$sql = "SELECT * FROM users WHERE login='$login' AND haslo='$password'";
		if($result=$mysqli->query($sql))
		{
			$users_num = $result->num_rows;
			if($users_num>0)
			{
				$tmp = $result->fetch_assoc();
				$_SESSION['zalogowany']=true;
				
				$_SESSION['id']=$tmp['id'];
				$_SESSION['imie']=$tmp['imie'];
				$_SESSION['nazwisko']=$tmp['nazwisko'];
				$_SESSION['adres']=$tmp['adres'];
				$_SESSION['kontakt']=$tmp['kontakt'];
				$_SESSION['e-mail']=$tmp['e-mail'];
				$_SESSION['wiek']=$tmp['wiek'];
				$_SESSION['plec']=$tmp['plec'];
				
				header('Location: ../index.php');
			}
			else
			{
				header('Location: ../index.php');
				echo "podałeś niełaściwy login lub haslo";
			}
			$result->free_result();
		}
		
	}
	
	
?>