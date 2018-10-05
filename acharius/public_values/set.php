<?php

//print all the data in an array (later in json)
$ip = $_GET['ip'];
$id = $_GET['id'];

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if (isset($_GET['l_i'])){
  //change intensity
  $l_i = $_GET['l_i'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET light_intensity = :li WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'li' => $l_i,
    'ip' => $ip,
    'id' => $id
  ));
}
else if( isset($_GET['l_s'])){
  //change state.
  //0=off;1=on;2=followschedule
  $l_s = $_GET['l_s'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET force_state_light = :fl WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'fl' => $l_s,
    'ip' => $ip,
    'id' => $id
  ));
}
else if (isset($_GET['w_s'])){
  //change state.
  //0=off;1=on;2=followschedule
  $w_s = $_GET['w_s'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET force_state_vapor = :fw WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'fw' => $w_s,
    'ip' => $ip,
    'id' => $id
  ));
}
else if (isset($_GET['w_i'])){
  //change state.
  //0=off;1=on;2=followschedule
  $w_i = $_GET['w_i'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET vapor_intensity = :wi WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'wi' => $w_i,
    'ip' => $ip,
    'id' => $id
  ));
}
else if (isset($_GET['p_s'])){
  //change state.
  //0=off;1=on;2=followschedule
  $l_s = $_GET['p_s'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET force_state_light = :fl WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'fl' => $l_s,
    'ip' => $ip,
    'id' => $id
  ));
}
else if (isset($_GET['p_i'])){
  $p_i = $_GET['p_i'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET pump_intensity = :p_i WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'p_i' => $p_i,
    'ip' => $ip,
    'id' => $id
  ));
}
else if (isset($_GET['light_color'])){
  $light_color = $_GET['light_color'];
  $upd = $bdd->prepare('UPDATE acharius_parcelles SET color = :color WHERE ip = :ip AND id_internal = :id');
  $upd->execute(array(
    'color' => $light_color,
    'ip' => $ip,
    'id' => $id
  ));
}

 ?>
