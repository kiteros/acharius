<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");

if(isset($_GET['type'])){
  if($_GET['type'] == 'parcel'){
    $_SESSION['current'] = "p".$_GET['id'];
    //id parcel bought
    header('Location: seed.php');

  }else if($_GET['type'] == 'seed'){
    $_SESSION['current'] .= "s".$_GET['id'];
    //id parcel bought
    header('Location: mold.php');
  }else if($_GET['type'] == 'mold'){
    $_SESSION['current'] .= "m".$_GET['id'];
    //id parcel bought
    //What do we do here?
  }
}

 ?>
