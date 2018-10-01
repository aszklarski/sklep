<?php
	session_start();

	if(isset($_POST['name']))
	{	
		require_once "../media/connect.php";
		$mysqli = new mysqli($host,$db_user,$db_password,$db_name);
		
		//walidacja udana? zakladam ze tak!!!!!
		$wszystko_ok=true;
		
		
		//sprawdzam czy ok
		$name = $_POST['name'];
		$price = $_POST['price'];
		$foto_name = $_POST['foto_name'];
		$category = $_POST['category'];
		$fota= $_POST['foto_img'];
		$adr = 'media/img/products/' .$foto_name. '.jpg';
		
		
		//Sprawdz poprawnosc loginu
		if(strlen($name)<3 ||strlen($name)>20)
		{
			$wszystko_ok=false;
			$_SESSION['e_name'] = "Login musi posiadać od 3 do 20 znaków";
		}
		
		if(ctype_alnum($name) == false)
		{
			$wszystko_ok = false;
			$_SESSION['e_name'] = "Login może składać się tylko z liter i cyfr ";
		}
		
		if($price == NULL)
		{
			$wszystko_ok=false;
			$_SESSION['e_price'] = "Hasło nie może być puste";
		}
		
		if($foto_name == NULL)
		{
			$wszystko_ok=false;
			$_SESSION['e_foto_name'] = "Hasło nie może być puste";
		}
		
		if($category == NULL)
		{
			$wszystko_ok=false;
			$_SESSION['e_category'] = "Hasło nie może być puste";
		}
		//baza danych
		try
		{
			if($mysqli->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				//Czy name istnieje
				$rezultat = $mysqli->query("SELECT * FROM store WHERE nazwa='$name'");
				
				if(!$rezultat) throw new Exception($mysqli->error);
				
				$ile_name = $rezultat->num_rows;
				if($ile_name>0)
				{
					$wszystko_ok = false;
					$_SESSION['e_name'] = "Istnieje już produkt o podanej nazwie";
				}
				
				//Czy zdjecie istnieje
				$rezultat = $mysqli->query("SELECT * FROM store WHERE zdjecie='$foto_name'");
				
				if(!$rezultat) throw new Exception($mysqli->error);
				
				$ile_foto = $rezultat->num_rows;
				if($ile_foto>0)
				{
					$wszystko_ok = false;
					$_SESSION['e_foto_name'] = "Istnieje już zdjecie o podanej nazwie";
				}
				
				if($wszystko_ok==true)
				{
					//dodaj produkt do bazy 
					if($mysqli->query("INSERT INTO store VALUES (NULL, '$name', '$price', '$foto_name', '$category'	) "))
					{
						$open = fopen ("$adr","a+");
						fwrite ($open, $fota);
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
				<h1>Dodaj produkt</h1>
				
				<form  method="post" >
					<div class="add-item">
						<p><input type="text" name="name"/> Nazwa</p>
						<?php
							if(isset($_SESSION['e_name']))
							{
								echo '<div class="error">'.$_SESSION['e_name'].'</div>';
								unset($_SESSION['e_name']);
							}
						?>
						<p><input type="text" name="price"/> Cena</p>
						<?php
							if(isset($_SESSION['e_price']))
							{
								echo '<div class="error">'.$_SESSION['e_price'].'</div>';
								unset($_SESSION['e_price']);
							}
						?>
						<p><input type="text" name="foto_name"/> Nazwa zdjęcia</p>
						<p><input type="file" accept="image/jpg"name="foto_img"/></p>
						<?php
							if(isset($_SESSION['e_foto_name']))
							{
								echo '<div class="error">'.$_SESSION['e_foto_name'].'</div>';
								unset($_SESSION['e_foto_name']);
							}
						?>
						<p><input type="text" name="category"/> Kategoria</p>
						<?php
							if(isset($_SESSION['e_category']))
							{
								echo '<div class="error">'.$_SESSION['e_category'].'</div>';
								unset($_SESSION['e_category']);
							}
						?>
						<input type="submit" value=" Dodaj produkt! "/>
					</div>
				</form>
			</div>
		</div>
			
	</body>
</html>