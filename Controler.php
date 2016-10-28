<?php
	session_start();
	include ('information.php');
	
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
			include ('homepage.php');
			break;
			
		case 'details':
			include ('Details.php');
			break;
			
		case 'cancel':
			session_destroy();
			include('homepage.php');
			break;
	}
			
?>
	