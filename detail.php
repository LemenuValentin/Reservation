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
		<form method ="post" action= "Controler.php">
		
		<?php   
		$affichage = "veuillez compléter le formulaire:";
		for($i = 0; $i < $info->getNbPlaces() ; $i++)
		{	
			$affichage .= "<br><tr>
						  <td>Nom : </td><td><input type='text' name='names[]' value='".$info->getName()[$i]."' ></td>
						  </tr>
						  <tr>
						  <td>Age: </td><td><input type='text' name='ages[]' value='".$info->getAge()[$i]."'></td>
						  </tr>
						  <tr>";
		}
		
		if(($info->getDestination() == "") && ($info->getNbPlaces() == ""))
				{
					echo "Vous devez entrer une destination et un nombre de voyageur";
				}
				elseif($info->getDestination() == "")
				{
					echo "Vous devez entrer une destination";
				}
				elseif($info->getNbPlaces() == "")
				{
					echo "Vous devez entrer un nombre de voyageur";
				}
				else
				{
					echo "$affichage";
				}
			?>
			</table><br>
			<input type='submit' value='Etape suivante' name='gotoresume' />
			<input type='submit' value='précédent' name="gotohomepage" />
			<input type='submit' value='Annuler' name="Cancel" />
			</form>
	</body>
</html>
