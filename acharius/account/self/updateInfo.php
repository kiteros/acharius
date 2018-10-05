<?php

session_start();
include("https://www.achariuslab.com/action/checkSession.php");

if(isset($_POST['username'])){
  //on suppose que c'est ok
  $id = $_POST['id'];


  $username = $_POST['username'];
  $fname = $_POST['name'];
  $lname = $_POST['lastname'];
  $email = $_POST['email'];
  $newpass = sha1($_POST['newpass']);
  $bday = $_POST['bday'];


  try
  {
    $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
  }
  catch(Exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }

  $upinfo = $bdd->prepare('UPDATE acharius_account SET fname = :fname, lname = :lname, username = :username, email = :email, birth = :birth, password = :password WHERE id = :id');
  $upinfo->execute(array(
    'fname' => $fname,
    'lname' => $lname,
    'username' => $username,
    'email' => $email,
    'birth' => $bday,
    'password' => $newpass,
    'id' => $id
  ));

  header('Location: index.php');

}

 ?>
