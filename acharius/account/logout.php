<?php
$res = setcookie("user", "", time() - 36000000000000, "/");
$res2 = setcookie("pass", "", time() - 36000000000000, "/");
unset($_COOKIE["user"]);
unset($_COOKIE["pass"]);

session_start();
$_SESSION = [];

session_unset();
session_destroy();







header("Location:../index.php");

 ?>
