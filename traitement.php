<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Réservation</title>
		<link href='style.css' type='text/css' rel='stylesheet' />
	</head>
	<body>
		<h1>RESERVATION</h1>
		<?php
		var_dump($_POST);
		$_SESSION['nbPlaces'] = $_POST['NombrePlaces'];
		$nbPlaces = $_POST['NombrePlaces'];
		if (isset($_POST['AssuranceAnnulation']))
		{
			$assurance = "oui";
		}
		else
		{
			$assurance = "non";
		}
		?>
		<table>
		<form method="post" action="traveler.php">
			<tr>
			<td>Destination</td><td><?php echo $_POST['Destination']?></td>
			</tr>
			<tr>
			<td>Nombre de places</td><td><?php echo $_POST['NombrePlaces']?></td>
			</tr>
			<tr>
			<td>Assurance annulation</td><td><?php echo $assurance ?></td>
			</tr>
		</table><br>
			<input type="submit" value="Etape suivante" /><input type="submit" value="Annuler réservation" /><input type="submit" value="Annuler réservation" />
		</form>
	</body>
</html>