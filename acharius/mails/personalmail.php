<?php

if(isset($_GET['subject']) and isset($_GET['email'])){
  $footer = file_get_contents('footer_mail.html');
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: AchariusLab@achariuslab.com'."\r\n".
    'Reply-To: contact@achariuslab.com'."\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $id_slot = $_GET['slot'];
  $id_parcel = $_GET['parcel'];
  $pricePayed = $_GET['price'];




  $comment = "<p>Thank you for your order at AchariusLab!</p>
  <p>Summary of your order : </p>
  <ul>
    <li>One slot (number " . $id_slot . " parcel " . $id_parcel . ") for " . $pricePayed . "€</li>

  </ul>

  <p>We hope that you will enjoy your slot, and that you will grow one of the most amazing plant ever ! </p>";




  $content = '<center><font size="3" face="Courier" color="#3a3a3a">' . $comment . '</font></center>'. $footer;
  $subject = $_GET['subject'];
  mail($_GET['email'],$subject, $content, $headers);
  header('Location: ../account/purchase/addslot.php?redirected=true');

}




 ?>
