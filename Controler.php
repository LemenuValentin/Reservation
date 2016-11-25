<?php
	session_start();
	include ('information.php');
	include ('traveler.php');
	
	$nbPlaces = "";
	$destination = "";
	$insurance = false;
	
	//Is there informations in the sessionRegarde si il y a une info dans la session
	if(!empty($_SESSION['info']))
	{
		//If there is one, we take it
		$info = unserialize($_SESSION['info']);
	}
	else
	{
		//If no informations, create a information object and save it in session as "info"
		$info = new information ($destination, $nbPlaces, $insurance);
		$_SESSION['info'] = serialize($info);	
	}
	
	//When we put on the button, we search values in homepage
	if (isset($_POST['submit']))
	{
		$nbPlaces = $_POST['NombrePlaces'];
		$destination = $_POST['Destination'];
		if (isset ($_POST['insurance']))
			{
				$insurance= true;
			}
	//New info		
	$info = new information ($destination, $nbPlaces, $insurance);
	$_SESSION['info'] = serialize($info);
	}
		
	//create or research a traveler
	if(!empty($_SESSION['passenger']))
	{  
		$passenger[]= unserialize($_SESSION['passenger']);
	}
	
	
	$passenger = array();
	$name = null;
	$age = null;
	
	if (isset($_POST['Submit1']))
	{
		for($i = 0; $i < $info-> get_traveler(); $i++)
		{		
			//Creation of a new array passenger
			if(isset($_POST['name'], $_POST['age']))
			{
				$name = $_POST['name'][$i];
				$age = $_POST['age'][$i];
			}
			
			$passenger[] = new traveler ($name,$age);
			
		}
		var_dump($passenger);
		$_SESSION['passenger'] = serialize($passenger);
	}
	
	
	//To know which page must be opened
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 'homepage';
	}
	
	switch($page)
	{	
		case 'homepage':
			include ('homepage.php'); //rajouter des is_file pour vérifier si on ouvre la bonne page.
			break;
			
		case 'details':
			include ('Details.php');
			break;
		
		case 'validation':
			include ('validation.php');
			break;
		
		case 'reservation':
			include ('reservation');
			break;
			
		case 'cancel':
			session_destroy();
			include('homepage.php');
			break;
	}
			
?>
	