<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");
include("../include/header.php");
include("../include/nav_participative_active.php");

     ?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Participative</h1>

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
      $searchparcels = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE status = 3');
      $searchparcels->execute(array(
        'id' => $_SESSION['id']
      ));
      while($data = $searchparcels->fetch()){
        //print all owned parcels
        //But first count user here
        $searchslots = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_parcel = :id');
        $searchslots->execute(array(
          'id' => $data['id']
        ));
        $nbGardeners = $searchslots->rowCount();
        ?>
        <div class="col-lg-4 col-md-10 col-xs-6">
          <a href="purchase/checkParticipativeOwnership.php?id=<?php echo $_SESSION['id'] . "&parcel=" . $data['id']; ?>" class="d-block mb-4 h-100">

            <?php
            if(file_exists("img/miniature/" . $data['id'] . ".png")){
              ?>
              <img class="img-fluid img-thumbnail" src="img/miniature/<?php echo $data['id'];?>.png" alt="">
              <?php
            }else{
              ?>
              <img class="img-fluid img-thumbnail" src="img/plantwait.png" alt="">
              <?php
            }?>


              <center><p class="t-below"><?php echo $data['name'];?> - Gardeners : <?php echo $nbGardeners;?>/25</p>
              <?php
                if($data['availability'] == 0){
                  echo "<p style=\"color:red;\">Available soon";
                }else{
                  $slotleft = 25-$nbGardeners;
                  echo "<p style=\"color:blue;\">" . $slotleft . " slots left";
                }
              ?></p></center>
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
