<?php
include_once('information.php');

//start a session if none was started
if(!isset($_SESSION['info']))
{
	session_start();
}  

#retrieve a session if one exists, else create a new object info
if (isset($_SESSION["info"])&& !empty($_SESSION['info'])) 
{
	$info = unserialize($_SESSION['info']);
}
else
{
	$info = new info();
}

//when press "Etape suivante" in homepage : Go to page 2 in detail if a destination, the nbrPlaces is given.
//set all data in info
if(!empty($_POST['go_to_detail']))
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
	//if an entry is empty, we stay on homepage and display an error on this page
	if ($info->homepageError() == "Veuillez compléter le formulaire")
    {
		include("detail.php");
	}
	else
	{
		include ("homepage.php");
	}
}

//go back to homepage if "Précédent" is pressed
if (!empty($_POST["back_to_homepage"]))
{
	include("homepage.php");
}
  
//in page Detail, save names and ages (arrays) and then go to page "summary" if 'Etape suivante' is pressed
if (!empty($_POST["go_to_resume"]))
{
	$info->setAge($_POST['ages']);
	$info->setName($_POST['names']);
	if ($info->detailError() == '')
	{
		include("summary.php");
	}
	else
	{
		include("detail.php");
	}
}

//if 'précédent' is pressed, go back to detail's page
if (!empty($_POST["back_to_detail"])) 
{
	include('detail.php');
}
	
//if "Annuler" is pressed, we go to homepage and delete the session
if (!empty($_POST["cancel"]))
{
    session_destroy();
    unset($info);
    include("homepage.php");
}
  
//if "confirmer" is pressed, we go to page confirmation 
//save all data in the database
if (!empty($_POST["go_to_confirmation"]))
{
	include("confirmation.php");
	//connection to DB
	$mysqli = new mysqli('localhost','root','','reservationbd');
	if ($mysqli->connect_errno)
	{
		echo 'Connection to DB failed'.$mysqli->connect_error;
	}
	
	//get info 
	$Destination = $info->getDestination();
	$NbPlaces = $info->getNbPlaces();
	$Insurance = $info->getInsurance();
	$Price = $info->Price();
	
	//NEW RESERVATION
	//Do not insert a new reservation in database if it's an edition of the administrator
	//getIDedition return the ID of the reservation which is edited by the admin
	//If it's a client reservation -> save destination, the number of places, Insurance and the price in the DB
	if($info->getIDedition() == 0)
	{
		$request = "INSERT INTO reservationbd.reservationinfo(Destination,NbPlaces,Insurance,Price) 
					VALUES('$Destination','$NbPlaces','$Insurance','$Price')";

		if($mysqli->query($request) === TRUE)
		{
			$id_res = $mysqli->insert_id; 
		}
		else
		{
			echo "Error inserting record: ".$mysqli->error;
		}
		
		//save the name and age of all travelers in DB
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
	//EDITION
	//If it's the admin who edits a reservation
	else
	{
		$dest = $info->getDestination();
		$Places = $info->getNbPlaces();
		$Insurance = $info->getInsurance();
		$Price = $info->Price();
		$ID = $info->getIDedition();
		
		//Update the database : destination, number of places, insurance and price
		$request3 = "UPDATE reservationbd.reservationinfo SET Destination = '$dest', NbPlaces = '$Places', Insurance = '$Insurance', Price = '$Price' WHERE IDres= '$ID'";
		if($mysqli->query($request3) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}
				
		//Edit name and age of travelers
		// 1) delete travelers's info to create a new to edit
		$delPassenger = 'DELETE FROM passenger WHERE IDres='.$ID;
		if($mysqli->query($delPassenger) === TRUE)
		{
			$id_insert = $mysqli->insert_id;
		}
		else
		{
			echo "Error inserting record: ".$mysqli->error;
		}
		
		// 2) Insert new travelers's info in the DB  
		$ArrayName = $info->getName();
		$ArrayAge = $info->getAge();
		for($i = 0; $i < $info->getNbPlaces() ; $i++)
		{
			$name = $ArrayName[$i];
			$age = $ArrayAge[$i];
			$editPassenger = "INSERT INTO reservationbd.passenger(Name,Age, IDres) VALUES('$name','$age','$ID')";           
			if($mysqli->query($editPassenger) === TRUE)
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

//Save info in session
if (isset($info))
{
	$_SESSION['info'] = serialize($info);
}


//if nothing has been given we are in homepage
if(empty($_POST['NbPlaces']) && empty($_POST["Destination"]) && empty($_POST['NbPlaces'])
	&& empty($_POST["back_to_resume"]) && empty($_POST["go_to_detail"]) && empty($_POST["back_to_homepage"]) 
	&& empty($_POST["back_to_detail"]) && empty($_POST["go_to_resume"]) && empty($_POST["go_to_confirmation"]) 
	&& empty($_POST["cancel"]))
	{
		include_once("homepage.php");
	}

?>