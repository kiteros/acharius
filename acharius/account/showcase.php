<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");

include("../include/header.php");

    include("../include/nav_showcase_active.php");

     ?>
    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Showcasing some exemples</h1>

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
      $searchparcels = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE status = 1');
      $searchparcels->execute(array(

      ));
      while($data = $searchparcels->fetch()){
        //print all owned parcels
        ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="../stream/index.php?id=<?php echo $data['id'];?>" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
            <center><p class="t-below"><?php echo $data['name']; ?></p></center>
          </a>
        </div>
        <?php
      }
      if($searchparcels->rowCount()==0){
        ?>
        <center><div>
          <p>Well that's a little empty here</p>
        </div></center>
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
