<?php
	session_start();
	include ('information.php');
	
	$nbPlaces = 0;
	$destination = "";
	$insurance = false;
	
	//Regarde si il y a une info dans la session
	if(!empty($_SESSION['info']))
	{
		//si il y en a une, on récupère l'objet 'info'
		$info = unserialize($_SESSION['info']);
	}
	else
	{
		//si il n'y a pas info en session, On crée l'objet information et on le sauve en session sous 'info'
		$info = new information ($destination, $nbPlaces, $insurance);
		$_SESSION['info'] = serialize($info);	
	}
	
	//quand on appuie sur le bouton, on va chercher les valeurs dans homepage
	if (isset($_POST['submit']))
	{
		$nbPlaces = $_POST['NombrePlaces'];
		$destination = $_POST['Destination'];
		if (isset ($_POST['insurance']))
			{
				$insurance= true;
			}
	}
	
	//Savoir quel page il faut ouvrir
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
	}
			
?>
	