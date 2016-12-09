<?php
include ('information.php');
session_start();
#Session recuperation
if (isset($_SESSION["info"])&& !empty($_SESSION['info'])) {
    $info = unserialize($_SESSION['info']);
  } 
else
  {
    $info = new info();
  }
//when press "Etape suivante" Go to page 2 (detail) if a destination, the nbrPlaces is given.
if(!empty($_POST['Submit']))
{
  $info->setDestination($_POST['Destination']);
  $info->setNbPlaces($_POST['NbPlaces']);
  if (isset($_POST['insurance']))
  {
    $info->setCheckbox('checked');
  }
  else
  {
    $info->setCheckbox('');
  }
  include("detail.php");
}
//Go back to homepage if "Précédent" is pressed

if (!empty($_POST["gotohomepage"]))
  {
    include("homepage.php");
  }
// In page Detail, save names and ages and then go to page "summary"
if (!empty($_POST["gotoresume"]))
  {
  $info->setAge($_POST['ages']);
  $info->setName($_POST['names']);
  include("summary.php");
  }
if (!empty($_POST["gotodetail"])) 
  {
  include ("detail.php");
  }
// If "Annuler" is pressed, we go to homepage and delete the session
if (!empty($_POST["Cancel"]))
  {
    session_destroy();
    unset($info);
    include("homepage.php");
  }
  
//If "confirmer" is pressed, we go to page confirmation 
if (!empty($_POST["gotoconfirmation"]))
  {
  include("confirmation.php");
  }
if (isset($info))
{
  $_SESSION['info'] = serialize($info);
}

//if nothing has been given we are in homepage
if(empty($_POST['NbPlaces']) && empty($_POST["Destination"]) && empty($_POST['NbPlaces']) && empty($_POST["Submit"]) && empty($_POST["gotohomepage"]) && empty($_POST["gotodetail"]) && empty($_POST["gotoresume"]) && empty($_POST["gotoconfirmation"]) && empty($_POST["Cancel"]))
  {
    include("homepage.php");
  }
?>