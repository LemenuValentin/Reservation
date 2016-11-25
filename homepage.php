<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
		<link href='style.css' type='text/css' rel='stylesheet' />
	</head>
	<body>
		<h1>RESERVATION</h1>
		<p> Le prix de la place est de 10 euros jusqu'à 12 ans et ensuite de 15 euros.<br>
			Le prix de l'assurance annulation est de 20 euros quel que soit le nombre de voyageurs.
		</p>
		<table>
		<?php //ATTENTION vérifier les valeurs entrées !!! ?>
		
		<form method="post" action="Controler.php?page=details">
			<tr>
			<td>Destination : </td><td><input type="text" name="Destination" value='<?php echo $info->get_destination(); ?>'/></td>
			</tr>
			<tr>
			<td>Nombre de places : </td><td><input type="text" name="NombrePlaces" value='<?php echo $info->get_traveler(); ?>' /></td>
			</tr>
			<tr>
			<td>Assurance annulation : </td><td><input type="checkbox"  name="insurance"  value='$info->get_insurance()' <?php if ($info->get_insurance()) echo 'checked'; ?>  /><br></td>
			</tr>
		</table><br>
			<input type="submit" value="Etape suivante" name='submit'/>
		</form>
		<form method='post' action='Controler.php?page=cancel'>
		<input type='submit' value='Annuler' />
		</form>
		
	<p>
	</body>
</html>