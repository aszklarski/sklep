<?php 
	
	session_start();
	
	
	if(isset($_POST['email']) && isset($_POST['age']))
	{	
		require_once "../media/connect.php";
		$mysqli = new mysqli($host,$db_user,$db_password,$db_name);
		
		//walidacja udana? zakladam ze tak!!!!!
		$wszystko_ok=true;
		
		//sprawdzam czy ok
		$login = $_POST['login'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];			
		$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
		$adres = $_POST['adres'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$age = $_POST['age'];
		
		
		


		//Sprawdz poprawnosc loginu
		if(strlen($login)<3 ||strlen($login)>20)
		{
			$wszystko_ok=false;
			$_SESSION['e_login'] = "Login musi posiadać od 3 do 20 znaków";
		}
		
		if(ctype_alnum($login) == false)
		{
			$wszystko_ok = false;
			$_SESSION['e_login'] = "Login może składać się tylko z liter i cyfr ";
		}
		
		//Sprawdzanie poprawnosci hasla
		if($password == NULL)
		{
			$wszystko_ok=false;
			$_SESSION['e_password'] = "Hasło nie może być puste";
		}
		if($password != $cpassword)
		{
			$wszystko_ok = false;
			$_SESSION['e_password'] = "Hasła nie są takie same";
		}
		
		//Sprawdzanie poprawnosci imienia
		if(strlen($name)<3 ||strlen($name)>20)
		{
			$wszystko_ok=false;
			$_SESSION['e_name'] = "Imie musi posiadać od 3 do 20 znaków";
		}
		
		//Sprawdzanie poprawnosci nazwiska
		if(strlen($surname)<3 ||strlen($surname)>30)
		{
			$wszystko_ok=false;
			$_SESSION['e_surname'] = "Nazwisko musi posiadać od 3 do 30 znaków";
		}
		
		//Sprawdz poprawnosc adresu email
		if (filter_var($emailB, FILTER_VALIDATE_EMAIL)== false || $emailB != $email)
		{
			$wszystko_ok = false;
			$_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
		}
		
		//BAZA DANYCH
		try
		{
			if($mysqli->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				//Czy login istnieje
				$rezultat = $mysqli->query("SELECT * FROM users WHERE login='$login'");
				
				if(!$rezultat) throw new Exception($mysqli->error);
				
				$ile_login = $rezultat->num_rows;
				if($ile_login>0)
				{
					$wszystko_ok = false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu email";
				}
				//Czy imie istnieje
				$rezultat = $mysqli->query("SELECT * FROM users WHERE imie='$name'");
				
				if(!$rezultat) throw new Exception($mysqli->error);
				
				$ile_imie = $rezultat->num_rows;
				if($ile_imie>0)
				{
					$wszystko_ok = false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu email";
				}
				//Czy nazwisko istnieje
				$rezultat = $mysqli->query("SELECT * FROM users WHERE nazwisko='$surname'");
				
				if(!$rezultat) throw new Exception($mysqli->error);
				
				$ile_nazwisko = $rezultat->num_rows;
				if($ile_nazwisko>0)
				{
					$wszystko_ok = false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu email";
				}
				//Czy email istnieje
				$rezultat = $mysqli->query("SELECT * FROM users WHERE email='$email'");
				
				if(!$rezultat) throw new Exception($mysqli->error);
				
				$ile_email = $rezultat->num_rows;
				if($ile_email>0)
				{
					$wszystko_ok = false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu email";
				}
				
				if($wszystko_ok==true)
				{
					//dodaj uzytkownika do bazy 
					if($mysqli->query("INSERT INTO users VALUES (NULL, '$login', '$password', '$name', '$surname', '$adres', '$contact', '$email', '$age', '$gender' ) "))
					{
						header('Location: ../index.php');					
					}
					else 
					{
						throw new Exception($mysqli->error);
					}
			
				}
			
								
				$mysqli->close();
			}
			
		}
		catch (Exception $e)
		{
			echo '<span>Błąd servera prosimy spróbowac w innym terminie!</span>';
			echo '</br> DEV: '. $e;
		}
		
		
		
		
		
		
	}
	
?>



<html lang="pl">
	<head>
		<meta content="text/html; charset=ISO-8859-2" http-equiv="content-type">
		<title>SklepAS</title>
		<link rel="stylesheet" href="media/css/styles.css">
	</head>
	<body>
		<div class="content">
			<div class="container">
				<h1>Rejestracja:</h1>
				
				<form  method="post" >
					<div class="register">
						<p><input type="text" name="login"/> Login</p>
						<?php
							if(isset($_SESSION['e_login']))
							{
								echo '<div class="error">'.$_SESSION['e_login'].'</div>';
								unset($_SESSION['e_login']);
							}
						?>
						<p><input type="text" name="password"/> Hasło</p>
						<?php
							if(isset($_SESSION['e_password']))
							{
								echo '<div class="error">'.$_SESSION['e_password'].'</div>';
								unset($_SESSION['e_password']);
							}
						?>
						<p><input type="text" name="cpassword"/> Powtórz hasło</p>
						<p><input type="text" name="name"/> Imie</p>
						<?php
							if(isset($_SESSION['e_name']))
							{
								echo '<div class="error">'.$_SESSION['e_name'].'</div>';
								unset($_SESSION['e_name']);
							}
						?>
						<p><input type="text" name="surname"/> Nazwisko</p>
						<?php
							if(isset($_SESSION['e_surname']))
							{
								echo '<div class="error">'.$_SESSION['e_surname'].'</div>';
								unset($_SESSION['e_surname']);
							}
						?>
						<p><input type="text" name="email"/> E-mail</p>
						<?php
							if(isset($_SESSION['e_email']))
							{
								echo '<div class="error">'.$_SESSION['e_email'].'</div>';
								unset($_SESSION['e_email']);
							}
						?>
						<p><input type="text" name="age"/> Wiek</p>
						<p><input type="text" name="adres"/> Adres</p>
						<p><input type="text" name="contact"/> Kontakt</p>
						<p><input type="text" name="gender"/> Plec</p>		
						<input type="submit" value="Rejestruj"/>
					</div>
				</form>
			</div>
		</div>
			
	</body>
</html>
	