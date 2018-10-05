<?php

session_start();
include("https://www.achariuslab.com/action/checkSession.php");

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
$searchparcels = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE id = :parcel');
$searchparcels->execute(array(
  'parcel' => $_GET['parcel']
));

$data = $searchparcels->fetch();
if($searchparcels->rowCount() > 0){
  //get la taille
  $size = $data['nb_slot_side'];
}else{
  $size = 0;
}

$owned = array();//toutes les slots prits dans cette parcelle
$searchowned = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_parcel = :parcel');
$searchowned->execute(array(
  'parcel' => $_GET['parcel']
));

while($data2 = $searchowned->fetch()){
  array_push($owned, $data2['id_slot']);
}



?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Seed - AchariusLab</title>
    <link rel="icon" href="https://achariuslab.com/img/logo/rond_small.png">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  </head>

  <body>

    <?php

    include("../../include/nav.php");

     ?>
    <!-- Page Content -->
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Thanks for your order</h1>
      <p>Send this link to a friend for him to get a completely free slot ! </p>
      <input type="text" value="http://achariuslab.com/account/purchase/shareFriend.php?key=fqltnqmxkvngrvc6gpa6"/><button onclick="saveclipboard()">Copy</button>
      <a href="../">Go back to my parcels</a>

      <script>

      function saveclipboard(){
        var el = document.createElement('textarea');
       // Set value (string to be copied)
       el.value = "http://achariuslab.com/account/purchase/shareFriend.php?key=fqltnqmxkvngrvc6gpa6";
       // Set non-editable to avoid focus and move outside of view
       el.setAttribute('readonly', '');
       el.style = {position: 'absolute', left: '-9999px'};
       document.body.appendChild(el);
       // Select text inside element
       el.select();
       // Copy text to clipboard
       document.execCommand('copy');
       // Remove temporary element
       document.body.removeChild(el);
      }


      </script>
      <style>
      input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
      }
      </style>



     </div>
   </div>
     <style>
     table, th, td {
       border: 1px solid black;

      }
      td {
        width: 50px;
        height:50px;
        position: relative;
      }

      .red{
        background-color:red;
      }

      td:hover{
        background-color: yellow;
      }



     </style>


    <!-- /.container -->
    <br/><br/>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Acharius Lab 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
