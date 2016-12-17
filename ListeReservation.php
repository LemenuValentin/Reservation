<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>ListeReservations</title>
		<link href='style.css' type='text/css' rel='stylesheet' />
	</head>
	<body>
		<h1>Liste des réservations</h1>
		<form method="post" action="Controler.php">
		<table>
			<tr>
			  <td>Destination</td>
			  <td>Nombre de Personnes</td>
			  <td>Assurance</td>
			  <td>Prix Total</td>
			  <td>Nom-Age</td>
			  <td>Editer</td>
			  <td>Supprimer</td>
			</tr>
		<?php
		$mysqli = new mysqli('localhost','root','','reservationbd');
		if($mysqli->connect_errno)
		{
			echo "Connection to DB failed".$mysqli->connect_error;
		}
		
		$query = "SELECT * FROM reservationinfo";
		$result = $mysqli->query($query);
		while($data = $result->fetch_assoc())
		{
			echo '<tr><td>'.$data['Destination'].'</td><td>'.$data['NbPlaces'].'</td><td>'.
            $data['Insurance'].'</td><td>'.$data['Price'].'</td><td>';
			
			$person_query = 'SELECT * FROM passenger WHERE '.$data['IDres'].' = passenger.IDres;';
			$person_result = $mysqli->query($person_query);

			  while ($row_person = $person_result->fetch_assoc())
			  {
				echo ''.$row_person['Name'].'-'.$row_person['Age'].'ans</br>';
			  }
			
			echo '<td><input type="submit" value="éditer" name="deleteDB" /></td>
				  <td><input type="submit" value="supprimer" name="deleteDB" /></td>';
		}
		
		$mysqli->close();
		?>
		</table><br>
		<input type='submit' name ='Cancel' value="Retour à la page d'acceuil" />
		</form>
	</body>
</html>