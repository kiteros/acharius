<?php

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if(isset($_GET['username'])){

  $username = $_GET['username'];
  $email = $_GET['email'];
  $fname = $_GET['fname'];
  $lname = $_GET['lname'];
  if($_GET['facebook'] == 1){
    $pass = sha1($_GET['id']);
  }else{
    $pass = sha1($_GET['password']);
  }

  //avant tout check si l'user existe deja. Si oui et fb, alors log in.




  $adduser = $bdd->prepare('INSERT INTO acharius_account (id, fname, lname, username, email, birth, password) VALUES (NULL, :fname, :lname, :usr, :email, :bday, :pass)');
  $adduser->execute(array(

    'fname' => $fname,
    'lname' => $lname,
    'usr' => $username,
    'email' => $email,
    'bday' => '',
    'pass' => $pass

  ));

  $searchmail = $bdd->prepare('SELECT * FROM acharius_email_list WHERE email = :email');
  $searchmail->execute(array(
    'email' => $email
  ));

  $nb = $searchmail->rowCount();

  if($nb == 0){
    //user has not already given his mail in beta vers.
    $addmail = $bdd->prepare('INSERT INTO acharius_email_list (id, email, first_name, last_name) VALUES (NULL, :mail, :fname, :lname)');
    $addmail->execute(array(
      'mail' => $email,
      'fname' => $fname,
      'lname' => $lname
    ));
  }



  //créer les variables de sessions

  $setsession = $bdd->prepare('SELECT * FROM acharius_account WHERE email = :email');
  $setsession->execute(array(
    'email' => $email
  ));

  $data = $setsession->fetch();

  session_start();
  $_SESSION['id'] = $data['id'];
  $_SESSION['fname'] = $data['fname'];
  $_SESSION['lname'] = $data['lname'];
  $_SESSION['username'] = $data['username'];
  $_SESSION['cart'] = array();

  echo "id" . $_SESSION['id'] . "fin id";

  //créer cookie
  if(!isset($_COOKIE["user"])) {
    $cookie_name = "user";
    $cookie_value = $email;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    $cookie_name2 = "pass";
    $cookie_value2 = $pass;
    setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
  }

  if(isset($_GET['redirect'])){
    header("Location: ..\account\purchase\getFreeParcel.php?parcel=1");
  }else{
    header("Location: ..\account\index.php");
  }

}else{
  header('Location: index.html?er=1');
}



 ?>
