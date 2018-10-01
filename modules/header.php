<?php
	session_start();
?>

<html lang="pl">
	<head>
		<meta content="text/html; charset=ISO-8859-2" http-equiv="content-type">
		<title>SklepAS</title>
		<link rel="stylesheet" href="media/css/styles.css">
		<script type="text/javascript" src="media/js/menu.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="header">
			<img class="headerimg" src="media/img/header.jpg">
			
			
			<?php
			include ("login_box.php");
			?>
			
	
		</div>

		<nav class="navi-main">
			<ul >
				<li><a href="index.php?page=home" title="tytul">Home</a></li>
				<li><a href="index.php?page=shop" title="tytul">Sklep</a></li>
				<li><a href="index.php?page=about" title="tytul">O nas</a></li>
				<li><a href="index.php?page=news" title="tytul">Aktualności</a></li>
				<li><a href="index.php?page=contact" title="tytul">Kontak</a></li>
				
			</ul>

		</nav>
		
		
