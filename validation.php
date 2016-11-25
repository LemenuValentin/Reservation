<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
		<link href='style.css' type='text/css' rel='stylesheet' />
	</head>
	
	<body>
	<h1>Validation des réservations</h1>
<p> 
	DESTINATION: <?php echo $info->get_destination() ?> </br>
	NOMBRE DE PLACES: <?php echo $info->get_traveler()?>
</p>
	
<table>
	<form method='post' action='controler.php?page=confirmation'>
	<?php 
		for($i = 0; $i < $info->get_traveler(); $i++)
		{
			echo ($i+1).' Nom:'.$passenger[$i]->get_name().'</br>';
			echo '</br> Age:'.$passenger[$i]->get_age().'</br></br>'; 
		}
		
		if ($info->get_insurance())
				{
				echo 'Assurance annulation: Oui';
				}
	?>
	<td align='center'> <input type='submit' value='Confirmer' name='submit2'> </td>
	</form>

	<form method='post' action='controller.php?page=details'>
	<td align='center'> <input type='submit' value='précédent'> </td>
	</form>
	<form method='post' action='controller.php?page=cancel'>
	<td align='center'> <input type='submit' value='Annuler'> </td>
	</form>
</table>
</body>
</html>