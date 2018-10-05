<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");
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
    <link href="css/thumbnail-gallery.css" rel="stylesheet">

  </head>

  <body>

    <?php

    include("../../include/nav.php");

     ?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Choose your seed</h1>

      <div class="row text-center text-lg-left">

      <?php

        //select all parcels owned by user
        try
        {
          $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
        }
        catch(Exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }
        $searchseeds = $bdd->prepare('SELECT * FROM acharius_seed');
        $searchseeds->execute(array(

        ));
        while($data = $searchseeds->fetch()){
          //print all owned parcels
          ?>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="" class="d-block mb-4 h-100">
              <?php
              //test si la connexion fonctionne
              if(1){
                ?>
                <img class="img-fluid img-thumbnail" src="img/seeds/<?php echo $data['id'] . ".png"; ?>" alt="">
                <center><p class="t-below" style=""><?php echo " " . $data['name']; ?></p></center>

                <?php
              }
               ?>

            </a>
          </div>
          <?php
        }

       ?>

     </div>
   </div>
     <style>
     p{
       margin-bottom: 0;
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
