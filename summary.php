
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
				//check if the user completed all informations
                if(in_array("",$info->getName()) || in_array("",$info->getAge()))
				{
					echo "veuiller compléter entièrement le formulaire !! ";
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
				}
				else
				{
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
				}
                
                ?>
                <tr>
                  <td>Assurance annulation:</td>
                  <td> <?php echo $info->getinsurance(); ?></td>
                </tr>
                </form>
              </table>
              <p> </p>
              <input type="submit" name="gotoconfirmation" value="Confirmer"/>
              <input type="submit" name= "gotodetail" value = "Retour à la page précédente"/>
              <input type="submit" name ="Cancel" value= "Annuler la réservation " />
      </body>
</html>