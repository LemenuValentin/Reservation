<!DOCTYPE html>
<html>
    <head>
        <title>Reservation</title>
        <link rel="stylesheet" type="text/css" href='style.css'
    </head>
	<body>
	  
        <h1>CONFIRMATION DES RESERVATIONS</h1>
		  
        <form method='post' action="Controler.php"
        <p>Votre demande a bien été enregistrée.<br>Merci de bien vouloir verser la somme de
        <?php 
        if (isset($info)) 
        {
			echo $info->getPrice()." euros sur le compte";
		}
		?>
		</p>
			<input type='submit' name='cancel' value="Retour à la page d'accueil"/>
			</form>
	</body>
</html>