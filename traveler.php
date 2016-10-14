<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
	</head>
	<body>
		<h1>DETAIL DES RESERVATION</h1>
		<table>
		<?php
		var_dump($_SESSION);
		die();
		$nbPlaces = $_SESSION['nbPlaces'];
		$affichage = "";
		//utiliser name=['age'] foreach
		for ($i=0;$i<$nbPlaces;$i++)
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
			<tr>
			<td><input type='submit' value='Etape suivante' /></td><td><input type='submit' value='Annuler réservation' /></td>
			</tr>
		</form>
		</table>";
		?>
	</body>
</html>