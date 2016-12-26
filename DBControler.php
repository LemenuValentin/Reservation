<?php
include_once('information.php');
//start a session if none was started
if(!isset($_SESSION['info']))
{
	session_start();
}  

//connection to the database
$mysqli = new mysqli('localhost','root','','reservationbd');
if ($mysqli->connect_errno)
{
	echo 'Connection to DB failed'.$mysqli->connect_error;
}

//read the DB
$query = "SELECT * FROM reservationinfo";
$result = $mysqli->query($query);
while($data = $result->fetch_assoc())
{
	$edit = 'edit'.$data['IDres'];
	$delete = 'delete'.$data['IDres'];
	
	//delete a reservation
	if(isset($_POST[$delete]) && !empty($_POST[$delete]))
	{
		$request1 = 'DELETE FROM passenger WHERE IDres='.$data['IDres'];
		$request2 = 'DELETE FROM reservationinfo WHERE IDres='.$data['IDres'];
		
		if($mysqli->query($request1) === TRUE)
		{
			$id_insert = $mysqli->insert_id;
		}
		else
		{
			echo "Error inserting record: ".$mysqli->error;
		}
		if($mysqli->query($request2) === TRUE)
		{
			$id_insert = $mysqli->insert_id;
		}
		else
		{
			echo "Error inserting record: ".$mysqli->error;
		}
		include("ListeReservation.php");
	}
	
	//Edit a reservation
	elseif(isset($_POST[$edit]) && !empty($_POST[$edit]))
	{
		//create a new info
		$info = new info();
		$_SESSION['info'] = $info;
		
		//Read in DB to set informations of the reservation we are editing
		//1) set destination, number of places, insurance (in reservationinfo table)
 		$info->setDestination($data['Destination']);
		$info->setNbPlaces($data['NbPlaces']);
		if ($data['Insurance'] == 'OUI')
		{
			$info->setCheckbox('checked');
		}
		else
		{
			$info->setCheckbox('');
		}
		//2) set name and age of travelers (in passenger table)
		$person_query = 'SELECT * FROM passenger WHERE '.$data['IDres'].' = passenger.IDres;';
		$person_result = $mysqli->query($person_query);
		$names = array();
		$ages = array();
		while ($row_person = $person_result->fetch_assoc())
		{
			$names[] = $row_person['Name'];
			$ages[] = $row_person['Age'];
		}
		$info->setName($names);
		$info->setAge($ages);
		$info->setIDedition($data['IDres']);
		//save informations in session
		$_SESSION['info'] = serialize($info);
		include_once('Controler.php');
		
	}
}
	
if (!empty($_POST['add']))
{
	include_once ('Controler.php');
}
elseif(empty($_POST['add']))
{
	include_once('ListeReservation.php');
}
	
?>