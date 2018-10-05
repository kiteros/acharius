<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");
//check if user buy or go in parcel
try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
$searchparcels = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_parcel = :parcel');
$searchparcels->execute(array(
  'parcel' => $_GET['parcel']
));
$ok = false;

while($data = $searchparcels->fetch()){


  if($data['id_owner'] == $_GET['id']){
    $ok = true;
    $id_parcel = $data['id_parcel'];
    $id_slot = $data['id_slot'];

    //le user est allow de rentrer dans la parcelle

  }

}
if(!$ok){
  header('Location: selectSlot.php?parcel=' . $_GET['parcel']);
}else{
  header('Location: ../../stream/participative_stream.php?id=' . $id_parcel . '&slot=' . $id_slot);
}

?>
