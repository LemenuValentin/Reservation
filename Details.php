<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
		<link href='style.css' type='text/css' rel='stylesheet' />
	</head>
	<body>
		<h1>DETAIL DES RESERVATION</h1>
		<table>
		<?php
		$affichage = "";
		//utiliser name=['age'] foreach
		for($i = 0; $i < $nbPlaces ; $i++)
		{	
			$affichage .= "<tr>
						  <td>Nom : </td><td><input type='text' name='name' /></td>
						  </tr>
						  <tr>
						  <td>Age: </td><td><input type='text' name='Age' /></td>
						  </tr>
						  <tr>";
		}
			echo "
			<form method='post' action='Confirmation.php'>
			$affichage
			</table><br>
			<input type='submit' value='Etape suivante' name='submit1' /><input type='submit' value='Etape précédente' name='submit2/><input type='submit' value='Annuler réservation' name='submit2' />
		</form>";
		?>
	</body>
</html>