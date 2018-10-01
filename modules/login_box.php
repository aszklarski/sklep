<?php
	if(!isset($_SESSION['zalogowany'])) 
	{
		echo '<div class="login">
			<form action="media/login.php" method="post">
			Login: <input type="text" name="login"/> 
			Hasło: <input type="password" name="password"/>
			<input type="submit" value="Zaloguj"/>
			<br/><a href="pages/register.php">Jeśli nie posiadasz konta zarejestruj się!</a>
			</form></div>';
	}
	else
	{
		echo '<div class="login">'. $_SESSION['imie'] .
		'<a class="btn-logout" href="media/logout.php">Wyloguj!</a>
		</div>';
	}
	

?>






			