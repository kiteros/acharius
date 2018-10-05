<?php

//print all the data in an array (later in json)

$ip = $_GET['ip'];
$id_i = $_GET['id'];

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

$getintensity = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE ip = :ip AND id_internal = :id_i');
$getintensity->execute(array(
  'ip' => $ip,
  'id_i' => $id_i
));


if($getintensity->rowCount() > 0){
  $data = $getintensity->fetch();
  echo "l_i=" . $data['light_intensity'] . ";";
  echo "w_i=" . $data['vapor_intensity'] . ";";
  echo "p_i=" . $data['pump_intensity'];
}else{
  echo "error";
}

 ?>
