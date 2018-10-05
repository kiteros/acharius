<?php

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if(isset($_GET['email'])){
  $email = $_GET['email'];
  if(isset($_GET['direct'])){
    $pass = $_GET['password'];
  }else{
    $pass = sha1($_GET['password']);
  }


  $searchmail = $bdd->prepare('SELECT * FROM acharius_account WHERE email = :mail');
  $searchmail->execute(array(
    'mail' => $email
  ));
  $data = $searchmail->fetch();
  $nb = $searchmail->rowCount();
  if($nb > 0){
    //users exists
    //check password
    if(strcmp($data['password'],$pass) == 0){
      //user can connect
      session_start();
      $_SESSION['id'] = $data['id'];
      $_SESSION['fname'] = $data['fname'];
      $_SESSION['lname'] = $data['lname'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['cart'] = array();

      //créer cookie
      if(!isset($_COOKIE["user"])) {
        $cookie_name = "user";
        $cookie_value = $email;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $cookie_name2 = "pass";
        $cookie_value2 = $pass;
        setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
      }



      header('Location: ../account/index.php');
    }else{
      //password not valid
      header('Location: index.php?er=0');
    }
  }else{
    //User not found
    header('Location: index.php?er=1');
  }

}

 ?>
