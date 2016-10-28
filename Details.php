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
			<input type='submit' value='Etape suivante' name='submit' />
			</form>
			<form method='post' action='Controler.php?=page=homepage'>
			<input type='submit' value='précédent' />
			</form>
			<form method='post' action='Controler.php?page=cancel'>
			<input type='submit' value='Annuler' />
			</form>";
		?>
	</body>
</html>