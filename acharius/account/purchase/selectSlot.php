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

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="icon" href="https://achariuslab.com/img/logo/rond_small.png">
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  </head>

  <style>
  /* Style The Dropdown Button */
  .dropbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
  }

  /* The container <div> - needed to position the dropdown content */
  .dropdown {
      position: relative;
      display: inline-block;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
  }

  /* Links inside the dropdown */
  .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
  }

  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {background-color: #f1f1f1}

  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content {
      display: block;
  }

  /* Change the background color of the dropdown button when the dropdown content is shown */
  .dropdown:hover .dropbtn {
      background-color: #3e8e41;
  }
  </style>

  <body>

    <?php

    include("../../include/nav.php");

     ?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Choose your slot</h1>
      <center><table>
        <?php
        $increment = 1;
        for($i = 0; $i < $size; $i++){
          ?>
          <tr>
          <?php
          for($j = 0; $j < $size; $j++){
            //if is checked take it
            if(in_array($increment, $owned)){
              //owned by someone -> print in red
              ?>
              <td class="slot red" id="<?php echo $increment;?>"><div><?php echo $increment;?></div></td>
              <?php
            }else{
              ?>
              <td class="slot" id="<?php echo $increment;?>"><div><?php echo $increment;?></div></td>
              <?php
            }


            $increment++;
          }
          ?>
          </tr>
          <?php
        }

         ?>
       </table></center>
       <script>
        $(".slot").click(function(){
          var id = $(this).attr('id');
          var classes = $(this).attr("class").split(' ');

          if(!classes.includes('red')){
            window.location.href="../view/participative_buy.php?parcel=" + <?php echo $_GET['parcel'];?> + "&slot=" + id;
          }

        });
       </script>






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
