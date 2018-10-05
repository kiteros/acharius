<?php

  session_start();
  include("../action/checkSession.php");
  include("../include/header.php");
  include("../include/nav_myparcels_active.php");


?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">All your parcels</h1>

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
      $searchparcels = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE id_owner = :id');
      $searchparcels->execute(array(
        'id' => $_SESSION['id']
      ));
      while($data = $searchparcels->fetch()){
        //print all owned parcels
        ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="../stream/index.php?id=<?php echo $data['id'];?>" class="d-block mb-4 h-100">
            <?php
            //test si la connexion fonctionne
            if(file_exists("img/miniature/" . $data['id'] . ".png")){
              ?>
              <img class="img-fluid img-thumbnail" src="img/miniature/<?php echo $data['id'];?>.png" alt="">
              <center><p class="t-below"><?php echo $data['name']; ?></p></center>
              <?php
            }else{
              ?>
              <img class="img-fluid img-thumbnail" src="img/plantwait.png" alt="">
              <center><p class="t-below"><?php echo $data['name']; ?></p></center>
              <?php
            }
             ?>

          </a>
        </div>
        <?php
      }

      $searchslots = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_owner = :id');
      $searchslots->execute(array(
        'id' => $_SESSION['id']
      ));
      while($data2 = $searchslots->fetch()){
        //search each time the parcel details
        $searchparcels2 = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE id = :id_parcel');
        $searchparcels2->execute(array(
          'id_parcel' => $data2['id_parcel']
        ));
        $data3 = $searchparcels2->fetch();
        $slot_id = $data2['id_slot'];
        ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="../stream/participative_stream.php?id=<?php echo $data3['id'];?>" class="d-block mb-4 h-100">
            <?php
            //test si la connexion fonctionne
            if(file_exists("img/miniature/" . $data3['id'] . ".png")){
              ?>
              <img class="img-fluid img-thumbnail" src="img/miniature/<?php echo $data3['id'];?>.png" alt="">
              <center><p class="t-below"><?php echo $data3['name']; ?>, <?php echo "slot ". $slot_id; ?></p></center>
              <?php
            }else{
              ?>
              <img class="img-fluid img-thumbnail" src="img/plantwait.png" alt="">
              <center><p class="t-below"><?php echo $data3['name']; ?>, <?php echo "slot ". $slot_id; ?></p></center>
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
    <!-- /.container -->

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
