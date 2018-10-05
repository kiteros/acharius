<?php
try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
$addmail = $bdd->prepare('SELECT * FROM acharius_request');
$addmail->execute(array(

));
while($data = $addmail->fetch()){
  if($data['request'] == 0){
    $req = "watering";
  }else if($data['request'] == 1){
    $req = "cut leaves";
  }else if($data['request'] == 2){
    $req = "harvest plant";
  }
  ?>
  <p><?php echo $data['id'];?> - <?php echo $req?> - <?php echo $data['special'];?> - <?php echo $data['date_'];?></p>
  <?php
}
?>
