<?php
include ('information.php');
session_start();

#Session recuperation
if (isset($_SESSION["info"])&& !empty($_SESSION['info'])) {
    $info = unserialize($_SESSION['info']);
  } 
else
  {
    $info = new info();
  }
//when press "Etape suivante" Go to page 2 (detail) if a destination, the nbrPlaces is given.
if(!empty($_POST['Submit']))
{
  $info->setDestination($_POST['Destination']);
  $info->setNbPlaces($_POST['NbPlaces']);
  if (isset($_POST['insurance']))
  {
    $info->setCheckbox('checked');
  }
  else
  {
    $info->setCheckbox('');
  }
  //if an entry is empty, we stay on homepage and desplay error
  if ($info->HomepageError() == "Veuillez compléter le formulaire")
    {
	include("detail.php");
	}
	else
	{
	include ("homepage.php");
	}
}

//Go back to homepage if "Précédent" is pressed

if (!empty($_POST["gotohomepage"]))
  {
    include("homepage.php");
  }
// In page Detail, save names and ages and then go to page "summary"
if (!empty($_POST["gotoresume"]))
  {
  $info->setAge($_POST['ages']);
  $info->setName($_POST['names']);
  if ($info->DetailError() == '')
  {
  include("summary.php");
  }
  else
  {
  include("detail.php");
  }
  }
if (!empty($_POST["gotodetail"])) 
  {
	include('detail.php');
	}
	
if (!empty($_POST["backtoresume"]))
	{
	include('summary.php');
	}
	
// If "Annuler" is pressed, we go to homepage and delete the session
if (!empty($_POST["Cancel"]))
  {
    session_destroy();
    unset($info);
    include("homepage.php");
  }
  
//If "confirmer" is pressed, we go to page confirmation 
if (!empty($_POST["gotoconfirmation"]))
  {
  include("confirmation.php");
  }
if (isset($info))
{
  $_SESSION['info'] = serialize($info);
}

if (!empty($_POST['gotoDB']))
	{
	$mysqli = new mysqli('localhost','root','','reservationbd');
	if ($mysqli->connect_errno)
	{
		echo 'Connection to DB failed'.$mysqli->connect_error;
	}
	
	$Destination = $info->getDestination();
	$NbPlaces = $info->getNbPlaces();
	$Insurance = $info->getInsurance();
	$Price = $info->Price();
	$request = "INSERT INTO reservationbd.reservationinfo(Destination,NbPlaces,Insurance,Price) VALUES('$Destination','$NbPlaces','$Insurance','$Price')";
	
		
		if($mysqli->query($request) === TRUE)
		{
			$id_res = $mysqli->insert_id;
		}
		else
		{
			echo "Error inserting record: ".$mysqli->error;
		}
		
	for($i = 0; $i < $info->getNbPlaces(); $i++)
	{
		$name = $info->getName()[$i];
		$age = $info->getAge()[$i];
		$request = "INSERT INTO reservationbd.passenger(Name,Age, IDres) VALUES('$name','$age','$id_res')";
		
		if($mysqli->query($request) === TRUE)
		{
			$id_insert = $mysqli->insert_id;
		}
		else
		{
			echo "Error inserting record: ".$mysqli->error;
		}
	}
	include("ListeReservation.php");
	}


//if nothing has been given we are in homepage
if(empty($_POST['NbPlaces']) && empty($_POST["Destination"]) && empty($_POST['NbPlaces']) && empty($_POST["Submit"]) && empty($_POST["gotohomepage"]) && empty($_POST["gotodetail"]) && empty($_POST["gotoresume"]) && empty($_POST["gotoconfirmation"]) && empty($_POST["Cancel"]) && empty($_POST['gotoDB']) && empty($_POST["backtoresume"]))
  {
	session_destroy();
	unset($info);
    include("homepage.php");
  }
?>