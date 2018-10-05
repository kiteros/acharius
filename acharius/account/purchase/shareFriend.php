<?php
$ipaddress = $_SERVER['REMOTE_ADDR'];

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

$getid = $bdd->prepare('SELECT * FROM acharius_slot');
$getid->execute(array(

));

$ok = true;

while($data = $getid->fetch()){
  if($data['ip'] == $ipaddress){
    $ok = false;
  }
}
if($ok){
  //check le id
  $ok2 = false;
  $checkkey = $bdd->prepare('SELECT * FROM acharius_sharekey');
  $checkkey->execute(array(

  ));
  while($data2 = $checkkey->fetch()){
    if($data2['key_'] == $_GET['key']){
      $ok2 = true;
    }
  }
  if($ok2){
    header('Location: ../../signup/index.php?d=aaxyu7bge8h75d9nkad3z');
  }else{
    echo "we are sorry but your key is not valid";
  }


}else{
  echo "we are sorry but you can't use this functionality with the same computer";
}

?>
