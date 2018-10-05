<?php
session_start();
include("https://www.achariuslab.com/action/checkSession.php");

$id = $_GET['parcel'];
$slot = $_GET['slot'];

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
  $size = $data['nb_slot_size'];
  $name = $data['name'];
  $price = $data['price'];
  $currentprice = $price;
  $max_duration = $data['max_duration'];
}else{
  //erreur

}


$countuser = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_parcel = :id');
$countuser->execute(array(
  'id' => $id
));
$data2 = $countuser->fetch();
$nbUser = $countuser->rowCount();

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
    <link rel="icon" href="https://achariuslab.com/img/logo/rond_small.png">

    <!-- Custom styles for this template -->
    <link href="css/portfolio-item.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


  </head>

  <body>

    <?php

    include("../../include/nav.php");

     ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Portfolio Item Heading -->
      <h1 class="my-4">Vacant slot
        <small><?php echo $name; ?>#<?php echo $slot;?></small>
      </h1>

      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-8">
          <img class="img-fluid" src="../img/parcel.png" alt="">
        </div>

        <div class="col-md-4">
          <h3 class="my-3">Description</h3>
          <p>Small slot for one plant, located among <?php echo $size*$size;?>other plants. Grow any small plant you want for all
            its lifespan. Get in competition with other, and find the best way to grow the strongest plant<p>This parcel is designed to grow one seed of one kind of plant. This size is ideal for the following plants :
              <ul>
                <li>Basil</li>
                <li>Mint</li>
                <li>Dwarf tomato</li>
                <li>Persil</li>
              </ul>
            </p>
            <?php

            if($nbUser <= 10){
              ?>
              <p>Price : <span style="color:blue; ">$0</span></p>
              <?php
            }else{
              ?>
              <p>Price : <span style="color:blue; ">$<?php echo $price; ?></span></p>
              <?php
            }


             ?>

            <p><span style="color:red; ">Free for the first 10 on this parcel (<?php
            if(10-$nbUser < 0){
              echo 0;

            }else{
              echo 10-$nbUser;
              $currentprice = 0;

            }

            ?> left), then <?php echo $price;?>€ per slot</span></p>
            <p>Max duration : all of your plant's lifespan</p>
        </div>

      </div>
      <!-- /.row -->
      <br/>
      <!--id en dessous correspond à l'id de la parcelle-->

      <button onclick="buy();" class="button">Get this parcel</button>
      <form method="post" action="../secure/secure.php" id="submit">
        <input type="hidden" name="type" value="participative"/>
        <input type="hidden" name="id" value="<?php echo $id;?>"/>
        <input type="hidden" name="slot" value="<?php echo $slot;?>"/>
        <input type="hidden" name="price" value="<?php echo $currentprice;?>"/>
        <input type="hidden" name="user" value="<?php echo $_SESSION['id'];?>"/>
        <input style="display:none" type="submit" value="submit"/>
      </form>

      <script>
        function buy(){

          $("#submit").submit();

        }

      </script>


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

      <br/><br/>

      <!-- Related Projects Row -->
      <h3 class="my-4">Rules of parcel and slot ownership</h3>

      <div class="row">

        <ul>
          <li>When you buy a slot in a participative parcel, you buy the right to plant any kind of seed, and to make
            it grow as long as it is alive</li>
          <li>Global parameters like the humididy, light intensity and color, and atomizing cylc of the parcel can be <section>
            by a super-user, that will be set every week by our teem. This super-user will be the one that has grown the more during the past
            week</li>
            <li>Each user has a daily credit that he can use to request actions on his plant. For exemple watering it, cut bad leaves or any other thing that he can think of</li>

          </section>
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
