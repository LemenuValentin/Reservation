<!DOCTYPE html>
<html>
    <head>
        <title>Reservation</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	  
        <h1>VALIDATION DES RESERVATIONS</h1>
		  
        <form method="post" action="Controler.php">
		  
            <table>
                <tr>
					<td>Destination:</td>
					<td><?php echo $info->getDestination(); ?></td>
                </tr>
                <tr>
					<td>Nombre de places:</td>
					<td><?php echo $info->getNbPlaces();?></td>
                </tr>

                <?php
					for ($i = 0; $i <$info->getNbPlaces(); $i++)
					{
						echo'
						<tr>
							<td>Nom:</td>
							<td> '.$info->getName()[$i].' </td>
							</tr>
							<tr>
							<td>Age:</td>
							<td> '.$info->getAge()[$i].'</td>
							</tr>';
					}
                ?>
                <tr>
					<td>Assurance annulation:</td>
					<td> <?php echo $info->getInsurance(); ?></td>
                </tr>
                </form>
            </table>
			  
            <p> </p>
            <input type="submit" name="go_to_confirmation" value="Confirmer"/>
            <input type="submit" name= "back_to_detail"" value = "Précédent"/>
            <input type="submit" name = "cancel" value= "Annuler la réservation " />
			  
    </body>
</html>