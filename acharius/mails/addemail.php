<?php

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
      die('Erreur : '.$e->getMessage());
}
if(isset($_POST['email'])){

  $mail = $_POST['email'];
  $fname = "";
  $lname = "";

  $addmail = $bdd->prepare('INSERT INTO acharius_email_list (id, email, first_name, last_name) VALUES (NULL, :mail, :fname, :lname)');
  $addmail->execute(array(
    'mail' => $mail,
    'fname' => $fname,
    'lname' => $lname
  ));

}

header('Location: ../');

?>
