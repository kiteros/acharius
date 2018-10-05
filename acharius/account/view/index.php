<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");

$id = $_GET['id'];

try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
//get all the infos of the parcel
$searchparcels = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE id = :id');
$searchparcels->execute(array(
  'id' => $id
));
$data = $searchparcels->fetch();
if($searchparcels->rowCount() > 0){
  //add to Vars
  $size = $data['size'];
  $name = $data['name'];
  $price = $data['price'];
  $max_duration = $data['max_duration'];
}else{
  //erreur

}

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buy a parcel - AchariusLab</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/portfolio-item.css" rel="stylesheet">

  </head>

  <body>

    <?php

    include("../../include/nav_vacant_active.php");

     ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Portfolio Item Heading -->
      <h1 class="my-4">Vacant parcel
        <small><?php echo $name; ?></small>
      </h1>

      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-8">
          <img class="img-fluid" src="http://placehold.it/750x500" alt="">
        </div>

        <div class="col-md-4">
          <h3 class="my-3">Description</h3>
          <p>Parcel of <?php echo $size; ?>cm by <?php echo $size; ?>cm, completely isolated from external perturbation. You can monitor light, atomization,
            Temperature and hydroponic water level, while getting a live feedback of your actions to your computer. </p>
            <p>This parcel is designed to grow one seed of one kind of plant. This size is ideal for the following plants :
              <ul>
                <li>Basil</li>
                <li>Mint</li>
                <li>Dwarf tomato</li>
                <li>Persil</li>
              </ul>
            </p>
            <p>Price : <span style="color:blue; ">$<?php echo $price; ?></span></p>
            <p>Max duration : <span style="color: red"><?php echo $max_duration; ?> months</p>
        </div>

      </div>
      <!-- /.row -->
      <br/>
      <!--id en dessous correspond à l'id de la parcelle-->
      <button onclick="window.location.href='../purchase/addSession.php?type=parcel&id=<?php echo $id; ?>'" class="button">Buy this parcel</button>
      <style>
      .button{
        background:#1AAB8A;
        color:#fff;
        border:none;
        position:relative;
        height:40px;
        font-size:1.3em;
        padding:0 2em;
        cursor:pointer;
        transition:800ms ease all;
        outline:none;
      }
      .button:hover{
        background:#fff;
        color:#1AAB8A;
      }
      .button:before,.button:after{
        content:'';
        position:absolute;
        top:0;
        right:0;
        height:2px;
        width:0;
        background: #1AAB8A;
        transition:400ms ease all;
      }
      .button:after{
        right:inherit;
        top:inherit;
        left:0;
        bottom:0;
      }
      .button:hover:before,button:hover:after{
        width:100%;
        transition:800ms ease all;
      }

      </style>

      <!-- Related Projects Row -->
      <h3 class="my-4">Rules of parcel ownership</h3>

      <div class="row">

        <ul>
          <li>When you buy a parcel, you buy a right to grow the plant of your choice for all its lifespan, and up to 6 or 9 month depending on the side of parcel.
          Basil plantations usually last less than 6 month. However, mint and other persistant aromatic plantations
        can live more than one year, therefore when your parcel time has reached to its end, you can purchase again 6 or 9 month of time for 50% off.</li>
          <li>In the price of the parcel is included the shippment to your house, if you accept so, of your plant once dryed.
          If you plant aromatic plants, it can be a good way to grow your own, without having to take care of it everyday</li>
          <li>It's up to you to determine when you want to "kill" your plant within your parcel validity time, and to get it dryed and sent to you</li>
          <li>The parcel price does not include the price of the seed, which usually ranges between $0.2 and 1$ per <span>cluster</span></li>
          <li>Every parcel is sold with some basic mold, sufficient to grow any plant correctly. However you can purchase
            more advanced and nutricious mold to be but in your parcel</li>
        </ul>

      </div>
      <!-- /.row -->

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
