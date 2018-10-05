<center><p>Envoyer message a toutes les adresses de la base</p></center>

<center><form action="" method="post" id="usrform">
  <input type="text" name="subject" placeholder="subject..."/>
  <br/>
  <input type="text" name="email" placeholder="adresse"/>
  <br/>
  <textarea rows="20" cols="100" placeholder="Enter message here..." name="comment" form="usrform"></textarea>
  <br/>
<input type="submit" value="envoyer">

</form></center>

<?php

$footer = file_get_contents('footer_mail.html');

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
      die('Erreur : '.$e->getMessage());
}

if(isset($_POST['subject']) and isset($_POST['comment'])){

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: AchariusLab@achariuslab.com'."\r\n".
    'Reply-To: contact@achariuslab.com'."\r\n" .
    'X-Mailer: PHP/' . phpversion();

  $addmail = $bdd->prepare('SELECT * FROM acharius_email_list');
  $content = '<font size="3" face="Verdana" color="#232323">' . $_POST['comment'] . '</font>'. $footer;
  $subject = $_POST['subject'];
  $addmail->execute(array());
  echo "envoye a : <br/><br/>";
  echo $_POST['email'];
  mail($_POST['email'],$subject, $content, $headers);


}

?>
