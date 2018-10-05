<?php
try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
$request = $_GET['a'];
$special = $_GET['s'];

$addmail = $bdd->prepare('INSERT INTO acharius_request (id, request, special, date_) VALUES (NULL, :request, :special, :dat)');
$addmail->execute(array(
  'request' => $request,
  'special' => " ",
  'dat' => "Jour : " . date("Y-m-d") . " time : " . date("h:i:sa")
));
header('Location: ../participative_stream.php?r=ok&id=' . $_GET['id']);

 ?>
