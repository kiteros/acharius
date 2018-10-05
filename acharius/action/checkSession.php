<?php

if(isset($_SESSION['id'])){
  if(!empty($_SESSION['id'])){
    //Everything is good
    
  }else{
    header('Location: https://www.achariuslab.com/login/');
  }
}else{
  header('Location: https://www.achariuslab.com/login/');
}


?>
