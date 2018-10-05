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

    <title>Buy a parcel - AchariusLab</title>
    <link rel="icon" href="https://achariuslab.com/img/logo/rond_small.png">

    <!-- Bootstrap core CSS -->
    <link href="../view/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../view/css/portfolio-item.css" rel="stylesheet">


  </head>

  <body>

    <?php

    include("../../include/nav.php");

     ?>

    <!-- Page Content -->
    <div class="container">

      <br/><br/><br/><br/>

      <p>You're about to buy a <?php echo $_POST['type'];?>  parcel, (parcel <?php echo $_POST['id'];?>,
        slot <?php echo $_POST['slot'];?>)
        for <span style="color:blue">$<?php echo $_POST['price'];?></p>
      <?php

      if($_POST['price'] == 0){
        ?>
        <p>Get your parcel directly <button onclick="addslot()">here</button></p>
        <script>
          function addslot(){
            window.location.href = "../purchase/addslot.php?user=" + <?php echo $_SESSION['id'];?> +
            "&parcel=" + <?php echo $_POST['id'];?> + "&slot=" + <?php echo $_POST['slot'];?> +
            "&price=" + <?php echo $_POST['price'];?>;
          }
        </script>
        <?php
      }else{
        ?>
        <br/><br/>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<div id="paypal-button-container"></div>
<script src="button.js"></script>
        <?php
      }

       ?>


        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; AchariusLab 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../view/vendor/jquery/jquery.min.js"></script>
    <script src="../view/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
