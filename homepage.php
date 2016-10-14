<?php
	session_start();
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
	</head>
	<body>
		<h1>RESERVATION</h1>
		<p> Le prix de la place est de 10 euros jusqu'à 12 ans et ensuite de 15 euros.<br>
			Le prix de l'assurance annulation est de 20 euros quel que soit le nombre de voyageurs.
		</p>
		<table>
		<?php //ATTENTION vérifier les valeurs entrées !!! ?>
		<form method="post" action="traitement.php">
			<tr>
			<td>Destination : </td><td><input type="text" name="Destination" /></td>
			</tr>
			<tr>
			<td>Nombre de places : </td><td><input type="text" name="NombrePlaces" /></td>
			</tr>
			<tr>
			<td>Assurance annulation : </td><td><input type="checkbox" value="value1" name="AssuranceAnnulation" /><br></td>
			</tr>
			<tr>
			<td><input type="submit" value="Etape suivante" /></td><td><input type="submit" value="Annuler réservation" /></td>
			</tr>
		</form>
	</table>
	<p>
	</body>
</html>