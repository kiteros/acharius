<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");

if($_GET['redirected'] == "true"){
  //redirect
  header('Location: thankpage.php');
}else{
  if(isset($_GET['user']) and isset($_GET['parcel']) and isset($_GET['slot']) and isset($_GET['price'])){
    $id_user = $_GET['user'];
    $id_parcel = $_GET['parcel'];
    $id_slot = $_GET['slot'];
    $pricePayed = $_GET['price'];
  }else {
    header('Location: session_expired.php');
  }


  try
  {
    $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
  }
  catch(Exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

  //before everything check if user already own a parcel
  $already = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_owner = :id');
  $already->execute(array(
    'id' => $id_user
  ));

  if($already->rowCount()>0){
    header('Location: error.php');
  }else{
    $searchusermail = $bdd->prepare('SELECT * FROM acharius_account WHERE id = :id');
    $searchusermail->execute(array(
      'id' => $id_user
    ));

    if($searchusermail->rowCount()>0){
      $mail_ = $searchusermail->fetch();
      $email = $mail_['email'];
    }else{
      echo "can't find your account";
    }

    //get mac adress
    $ipaddress = $_SERVER['REMOTE_ADDR'];

    //Search si user n'a pas deja une parcel avec cet ip
    $searchparcelsip = $bdd->prepare('INSERT INTO acharius_slot (id, id_slot, id_owner, id_parcel, ip) VALUES (NULL, :slot, :owner, :parcel, :ip)');
    $searchparcelsip->execute(array(
      'slot' => $id_slot,
      'owner' => $id_user,
      'parcel' => $id_parcel,
      'ip' => $ipaddress
    ));


    $searchparcels = $bdd->prepare('INSERT INTO acharius_slot (id, id_slot, id_owner, id_parcel, ip) VALUES (NULL, :slot, :owner, :parcel, :ip)');
    $searchparcels->execute(array(
      'slot' => $id_slot,
      'owner' => $id_user,
      'parcel' => $id_parcel,
      'ip' => $ipaddress
    ));


    $getid = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_owner = :owner AND id_slot = :slot AND id_parcel = :parcel');
    $getid->execute(array(
      'slot' => $id_slot,
      'owner' => $id_user,
      'parcel' => $id_parcel
    ));

    if($getid->rowCount()>0){
      //Send confirmation mail
      $subject = "thanks for your order at AchariusLab !";
      header("Location: ../../../mails/personalmail.php?subject=" . $subject .
      "&email=" . $email . "&price=" . $pricePayed . "&parcel=" .
       $id_parcel . "&slot=" . $id_slot);

    }else{
      echo "cant' find your slot";
    }
  }


}







 ?>
