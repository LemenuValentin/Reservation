<?php
session_start();
include_once('information.php');

$mysqli = new mysqli('localhost','root','','reservationbd');
	if ($mysqli->connect_errno)
	{
		echo 'Connection to DB failed'.$mysqli->connect_error;
	}

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
	//elseif (!empty($_POST[$edit]))
	elseif(isset($_POST[$edit]) && !empty($_POST[$edit]))
	{
		/*if (isset($_SESSION["info"])&& !empty($_SESSION['info']))
		{
		session_destroy();
		unset($info);
		}*/
		//session_start();
		$info = new info();
		$_SESSION['info'] = $info;
		//var_dump($data['Destination']);
		//var_dump($data['NbPlaces']);
		//var_dump($data['Insurance']);
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
		//$_SESSION['info'] = serialize($info);
		//Price??
		$person_query = 'SELECT * FROM passenger WHERE '.$data['IDres'].' = passenger.IDres;';
		$person_result = $mysqli->query($person_query);
		$names = array();
		$ages = array();
		while ($row_person = $person_result->fetch_assoc())
		{
			//var_dump($row_person['Name']);
			//$info->setAge($row_person['Age']);  //setAge(array of string) !!
			//var_dump($row_person['Age']); 
			//$info->setName($row_person['Name']);
			$names[] = $row_person['Name'];
			$ages[] = $row_person['Age'];
		}
		$info->setName($names);
		$info->setAge($ages);
		/*var_dump($info->getDestination());
		var_dump($info->getNbPlaces());
		var_dump($info->getinsurance());
		var_dump($info->getName());
		var_dump($info->getAge());
		var_dump($data['IDres']);*/
		$info->setIDedition($data['IDres']);
		//var_dump($info);
		$_SESSION['info'] = serialize($info);
		include_once('Controler.php');
		
		/*$request3 = 'UPDATE inforeservation SET Destination ='.$info->getDestination().' NbPlaces ='.$info->getNbPlaces().' Insurance ='.$info->getinsurance().' WHERE IDres='.$data['IDres'];
		//$request4 = 'UPDATE passenger SET Name ='.$info->getName().' Age ='.$info->getAge().' WHERE IDres='.$data['IDres'];
				if($mysqli->query($request3) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}
				/*if($mysqli->query($request4) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}*/
		/*if (!empty($_POST["gotoconfirmation"]))
		{
				$request3 = 'UPDATE inforeservation SET Destination ='.$info->getDestination.' NbPlaces ='.$info->getNbPlaces.' Insurance ='.$info->getinsurance.' WHERE IDres='.$data['IDres'];
				$request4 = 'UPDATE passenger SET Name ='.$info->getName.' Age ='.$info->getAge.' WHERE IDres='.$data['IDres'];
				if($mysqli->query($request3) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}
				if($mysqli->query($request4) === TRUE)
				{
					$id_insert = $mysqli->insert_id;
				}
				else
				{
					echo "Error inserting record: ".$mysqli->error;
				}
		}*/
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