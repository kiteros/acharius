<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");
  include("../include/header.php");
    include("../include/nav_vacant_active.php");

     ?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Parcels to buy</h1>

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
        $searchparcels = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE status = 2');
        $searchparcels->execute(array(

        ));
        while($data = $searchparcels->fetch()){
          //print all owned parcels
          ?>
          <div class="col-lg-3 col-md-4 col-xs-6">
            <a <?php
            if($data['availability'] == 1){
              echo "href=\"view/index.php?id=" . $data['id'] . "\"";
            }else{
              echo "href=\"\"";
            }
            ?> class="d-block mb-4 h-100">
              <?php
              //test si la connexion fonctionne
              if(1){
                ?>
                <img class="img-fluid img-thumbnail" src="img/plantwait.png" alt="">
                <div style="float:left; display:inline-block;"><p class="t-below" style=""><?php echo " " . $data['name']; ?></p>
                <p style="color:red;"><?php
                  if($data['availability'] == 0){
                    echo "unavailable";
                  }
                ?></p></div>
                <p class="t-below" style="float:right; color:blue;font-size:1.6em;"><?php echo "$" . $data['price']; ?></p>
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
