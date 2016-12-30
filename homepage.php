<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
		<link rel='stylesheet' type='text/css' href='style.css' />
	</head>
	<body>
	
		<h1>RESERVATION</h1>
		
		<b><div class="warning"><?php if(isset($info) 
			&& !empty($_POST['go_to_detail'])) echo $info->homepageError();?></div></b>
			
		<p> Le prix de la place est de 10 euros jusqu'à 12 ans et ensuite de 15 euros.<br>
			Le prix de l'assurance annulation est de 20 euros quel que soit le nombre de voyageurs.
		</p>
		
		<table>
		<form method="post" action="Controler.php">
			<tr>
			<td>Destination : </td><td><input type="text" name="Destination" 
				value='<?php if(isset($info)) echo $info->getDestination(); ?>'/></td>
			</tr>
			<tr>
			<td>Nombre de places : </td><td><input type="number" name="NbPlaces" 
				value='<?php if(isset($info)) echo $info->getNbPlaces();?>' /></td>
			</tr>
			<tr>
			<td>Assurance annulation : </td><td><input type="checkbox"  name="insurance"  
				value="<?php if(isset($info)) echo $info->getCheckbox()?>" checked /><br></td>
			</tr>
		</table><br>
		
		<input type='submit' name ="go_to_detail" value= "Etape suivante" />
		<input type='submit' name ='cancel' value='Annuler' />
		
		</form>
	</body>
</html>