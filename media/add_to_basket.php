<?php
	session_start();

	
	//dodawanie do kosza
	if(isset($_POST['hidden_id'])){
		$bag = array(
				'id' => $_POST['hidden_id'],
				'name' => $_POST['hidden_name']
		);
		
		$test = array_column($_SESSION['stack'], 'id');
		
		if(!in_array($_POST['hidden_id'], array_column($_SESSION['stack'],'id'))){
			array_push($_SESSION['stack'], $bag );
		}
		
		
		
		
		
		
			
	
		
		
	}
	//kasowanie kosza
	if(isset($_POST['kasujkosz'])){
		echo 'kasujemy kosz';
		$_SESSION['stack'] = array();			
		unset($_POST['kasujkosz']);
		
	}
	
	
	
	
	
	
	//wyswietlanie kosza	
	foreach($_SESSION['stack'] as $key => $value){
		echo $_SESSION['stack'][$key]['id'].  $_SESSION['stack'][$key]['name'] .'</br>';
	}
	

	echo '	<form method=post>
				<input type="hidden" name="kasujkosz" value="true" />
				<input type="submit" value="wyczysc koszyk" />
			</form>'
	
	
?>