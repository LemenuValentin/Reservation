<?php
include_once('information.php');

if(!isset($_SESSION['info']))
{
	session_start();
}  


#Session recuperation
if (isset($_SESSION["info"])&& !empty($_SESSION['info'])) {
    $info = unserialize($_SESSION['info']);
  } 
else
  {
    $info = new info();
  }

//var_dump($info);
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
	$mysqli = new mysqli('localhost','root','','reservationbd');
	if ($mysqli->connect_errno)
	{
		echo 'Connection to DB failed'.$mysqli->connect_error;
	}
	
	$Destination = $info->getDestination();
	$NbPlaces = $info->getNbPlaces();
	$Insurance = $info->getInsurance();
	$Price = $info->Price();
	//var_dump($info->getIDedition());
	//var_dump($info);
	if($info->getIDedition() == 0)
	{
	$request = "INSERT INTO reservationbd.reservationinfo(Destination,NbPlaces,Insurance,Price) VALUES('$Destination','$NbPlaces','$Insurance','$Price')";
	
		
		if($mysqli->query($request) === TRUE)
		{
			$id_res = $mysqli->insert_id; //donne l'id de la réservation
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
	}
	else
	{
		$dest = $info->getDestination();
		$Places = $info->getNbPlaces();
		$Insurance = $info->getinsurance();
		$ID = $info->getIDedition();
		
		//récupérer l'id de name et age pour pouvoir les modifiers un à un
		$request3 = "UPDATE reservationbd.reservationinfo SET Destination = '$dest', NbPlaces = '$Places', Insurance = '$Insurance' WHERE IDres= '$ID'";
		if($mysqli->query($request3) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}
				
		$ArrayName = $info->getName();
		$ArrayAge = $info->getAge();
		//var_dump($ArrayName);
		//var_dump($ArrayAge);
		
		$person_query = "SELECT * FROM passenger WHERE IDres ='$ID'";
		$person_result = $mysqli->query($person_query);
		$idpassenger = array();
		while ($row_person = $person_result->fetch_assoc())
		{
			$idpassenger[] = $row_person['id'];
		}
		//var_dump($idpassenger);
		//var_dump($info->getNbPlaces());
		for($i = 0; $i < $info->getNbPlaces() ; $i++)
		{
		$name = $ArrayName[$i];
		$age = $ArrayAge[$i];
		//var_dump($name);
		//var_dump($age);
		$id = $idpassenger[$i];
		$request4 = "UPDATE reservationbd.passenger SET Name ='$name', Age ='$age' WHERE id='$id'";
				
				if($mysqli->query($request4) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}
		}
	}
	}
  
if (isset($info))
{
  $_SESSION['info'] = serialize($info);
}

if (!empty($_POST['gotoDB']))
{
	include('ListeReservation.php');
}

//if nothing has been given we are in homepage
if(empty($_POST['NbPlaces']) && empty($_POST["Destination"]) && empty($_POST['NbPlaces']) && empty($_POST["backtoresume"]) && empty($_POST["Submit"]) && empty($_POST["gotohomepage"]) && empty($_POST["gotodetail"]) && empty($_POST["gotoresume"]) && empty($_POST["gotoconfirmation"]) && empty($_POST["Cancel"]) && empty($_POST["gotoDB"]))
	{
		include_once("homepage.php");
	}

?>