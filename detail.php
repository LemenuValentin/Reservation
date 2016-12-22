<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Reservation</title>
		<link href='style.css' type='text/css' rel='stylesheet' />
	</head>
	<body>
		<h1>DETAIL DES RESERVATION</h1>
		<br/><br/><b><div class="warning"><?php if(isset($info)) echo $info->DetailError();?></div></b>
		<table>
		<form method ="post" action= "Controler.php">
		
		<?php   
		$affichage = "";
		for($i = 0; $i < $info->getNbPlaces() ; $i++)
		{	
			$affichage .= "<br><tr>
						  <td>Nom : </td><td><input type='text' name='names[]' value='".$info->getName()[$i]."' ></td>
						  </tr>
						  <tr>
						  <td>Age: </td><td><input type='number' name='ages[]' value='".$info->getAge()[$i]."'></td>
						  </tr>
						  <tr>";
		}
			echo "$affichage";
			?>
			</table><br>
			<input type='submit' value='Etape suivante' name='gotoresume' />
			<input type='submit' value='précédent' name="gotohomepage" />
			<input type='submit' value='Annuler' name="Cancel" />
			</form>
	</body>
</html>
