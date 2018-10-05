<script>
//put the adress back in http to allow it to take ip live which are not in https
if (location.protocol != 'http:')
{
 location.href = 'http:' + window.location.href.substring(window.location.protocol.length);
}
</script>
<script src="js/sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<?php
session_start();
//get ip adress
try
{
  $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
if(isset($_GET['id'])){


  $addmail = $bdd->prepare('SELECT * FROM acharius_slot WHERE id_owner = :id');
  $addmail->execute(array(
    'id' => $_SESSION['id']
  ));
  $data2 = $addmail->fetch();
  if($addmail->rowCount()==0){
    //user dont own a slot
    header('Location: ../account/index.php');
  }else{
    $slot_id = $data2['id_slot'];

  }




  function rgbtohex($R, $G, $B)
  {

    $R = dechex($R);
    if (strlen($R)<2)
    $R = '0'.$R;

    $G = dechex($G);
    if (strlen($G)<2)
    $G = '0'.$G;

    $B = dechex($B);
    if (strlen($B)<2)
    $B = '0'.$B;

    return '#' . $R . $G . $B;
  }

  $getgate = $bdd->prepare('SELECT * FROM acharius_parcelles WHERE id = :id');
  $getgate->execute(array(
    'id' => $_GET['id']
  ));
  $data = $getgate->fetch();


  $ip = $data['ip'];
  $gate = $data['gate'];

  $birthday = $data['create_date'];
  $now = date("Y-m-d");

  //We want to update also the saved parameters of the plant
  $light_intensity = $data['light_intensity'];
  $light_status = $data['force_state_light'];

  $color = $data['color'];
  $color_r = explode(";",$color)[0];
  $color_g = explode(";",$color)[1];
  $color_b = explode(";",$color)[2];

  $color = rgbtohex($color_r, $color_g, $color_b);


}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acharius Live</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/toggle-switch.css" rel="stylesheet" />
    <link href="css/toggle-switch2.css" rel="stylesheet" />
    <link href="css/toggle-switch3.css" rel="stylesheet" />


    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <link rel="icon" href="img/icon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>





</head>

<?php


if(isset($_GET['r'])){
  if(strcmp($_GET['r'], "ok") == 0){

    // validate user actions
    ?>
    <script>
$(document).ready(function() {
    swal({
        title: 'Request sent',
        text: "Our team is on its way to fill your request within 12h",
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ok'
      }).then((result) => {
        if (result.value) {
          window.location.href = "?id=" + <?php echo $_GET['id'];?>;
        }
      })
  });
    </script>
    <?php
  }
}


  ?>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/live.png" width="50px" style="position: relative;top: -5px;"/>
                      <font face="arial black" size="5em" color="white">AchariusLive</font>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Telemetry</span>
                  </a>
                  <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                    <li>
                      <a>Hygrometry : <span class="data">data not available</span></a>
                    </li>
                    <li>
                      <a>Temperature : <span class="data">data not available</span></a>
                    </li>
                    <li>
                      <a>Luminosity : <span class="data">data not available</span></a>
                    </li>
                    <li>
                      <a>Water remaining in tank : <span class="data">data not available</span></a>
                    </li>
                    <li>
                      <a>Age : <span class="data"><?php echo date_diff(date_create($birthday), date_create($now))->format('%a days'); ?></span></a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Actions Pages">
                  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseActionsPages" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Actions</span>
                  </a>
                  <ul class="sidenav-second-level collapse" id="collapseActionsPages">


                      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Water Pages">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseWaterPages" data-parent="#exampleAccordion">
                          <i class="fa fa-fw fa-file"></i>
                          <span class="nav-link-text">Requests</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseWaterPages">
                          <li>
                            <a onclick="askwatering()" style="color:white">Request watering</a>
                          </li>
                          <script>
                          function askwatering(){


                            swal({
                              title: 'Are you sure about this request?',
                              text: "Water my plant",
                              type: 'question',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Yes'
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = 'actions/request.php?a=0&id=' + <?php echo $_GET['id'];?>;
                              }
                            })
                          }
                          </script>
                          <li>
                            <a onclick="askcutting()" style="color:white">Request bad leaves cutting</a>
                          </li>
                          <script>
                          function askcutting(){


                            swal({
                              title: 'Are you sure about this request?',
                              text: "Cut bad leaves",
                              type: 'question',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Yes'
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = 'actions/request.php?a=1&id=' + <?php echo $_GET['id'];?>;
                              }
                            })
                          }
                          </script>
                          <li>
                            <a onclick="askharvest()" style="color:white">Request plant harvesting</a>
                          </li>
                          <script>
                          function askharvest(){


                            swal({
                              title: 'Are you sure about this request?',
                              text: "Harvest my whole plant",
                              type: 'question',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Yes'
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = 'actions/request.php?a=2&id=' + <?php echo $_GET['id'];?>;
                              }
                            })
                          }
                          </script>
                        </ul>
                      </li>
                    </li>
                  </ul>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link nav-link-collapse collapsed" href="exit.php?id=<?php echo $_GET['id'];?>">
                      <span class="nav-link-text">Exit</span>
                    </a>
                  </li>
                </li>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <center><div class="holds-the-iframe"><iframe id="mainframe" src="http://<?php echo $ip . ":" . $gate ?>/" width="700px" height="520px" frameborder="0"></iframe>


                  </center></div><center>
                    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Open Menu</a>
                  <p style="color:white">Slot : <?php echo $slot_id;?></center>


            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2902035835418569",
    enable_page_level_ads: true
  });
</script>
    </div>
    <!-- /#wrapper -->

</body>

</html>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/WaterStateRequest.js"></script>
<script src="js/AtomizerSchedule.js"></script>
<script>
//gathering all the scripts here

function CheckSession() {
            var session = '<%=Session["username"] != null%>';
            //session = '<%=Session["username"]%>';
            if (session == false) {
                alert("Your Session has expired");
                window.location = "../login/index.php";
            }
        }

setInterval(CheckSession(),500);




var listarray = [];
var results = [];
var liststring = [];

//when time of the day is checked
$(".hour").click(function(e)
{
  //check which class it belongs to
  var classList = this.className.split(/\s+/);
  for (var i = 0; i < classList.length; i++) {
      if (classList[i] === 'active') {
          //do something
          $(this).css("background-color", "#eee");
          $(this).removeClass("active");
      }else{
        $(this).css("background-color", "red");
        $(this).addClass("active");
      }
  }

  //Add class to element
  //but check before if id is in array. if so, remove it
  if(listarray.includes(parseInt($(this).attr('id')))){
    //remove it
    var pos = listarray.indexOf(parseInt($(this).attr('id')));
    listarray.splice(pos,1);
  }else{
    //add it
    listarray.push(parseInt($(this).attr('id')));
  }

  if(listarray.length>0){
    //arrange text
    var total = 0;
    listarray.sort(function(a, b){return a-b});
    results = [];
    var first = true;
    var current = 0;
    for(var i = 0; i < listarray.length; i++){
      if(first){
        results.push(listarray[i]);
        current = listarray[i];
        first = false;
        continue;
      }
      if(i == listarray.length - 1){
        if(listarray[i] - current > 1){
          results.push(current);
        }

        results.push(listarray[i]);
      }else{
        if(listarray[i] == current+1){
          current = listarray[i];

        }else{
          results.push(current);
          current = listarray[i];
          results.push(listarray[i]);
        }
      }

    }
    //phase 2
    var textpair = [];
    var next = 0;
    if(results.length % 2 ==0){
      for(var i = 0; i < results.length; i+=2){

        if(results[i+1] +1 == 24){
          next = 0;
        }else{
          next = results[i+1] +1;
        }
        if(next == 0){
          total += 24 - results[i];
        }else{
          total += next - results[i];
        }

        textpair.push("From " + results[i] + "h00 to " + next + "h00");
      }
    }else{
      for(var i = 0; i < results.length-1; i+=2){
        if(results[i+1] +1 == 24){
          next = 0;
        }else{
          next = results[i+1] +1;
        }
        textpair.push("From " + results[i] + "h00 to " + next + "h00");

        if(next == 0){
          total += 24 - results[i];
        }else{
          total += next - results[i];
        }
      }
      if(results[i] +1 == 24){
        next = 0;
      }else{
        next = results[i] +1;
      }
      textpair.push("From " + results[i] + "h00 to " + next + "h00");

      if(next == 0){
        total += 24 - results[i];
      }else{
        total += next - results[i];
      }
    }



  }
  $("#sched").empty();
  first = false;
  for(var i = 0; i < textpair.length; i++){
    if(first){
      $("#sched").append("<br/>");
    }
    $("#sched").append(textpair[i]);
    first = true;

  }
  $("#tot").empty();
  $("#nocycle").empty();
  $("#tot").append("<span class=\"data\">" + total + "</span>");



  //add to text
});


// When the user clicks on div, open the popup

function myFunction() {

  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
  blocked = true;

}


function fermer2(){
  var popup2 = document.getElementById("myPopup2");
  popup2.classList.toggle("show");
}


//Toggle menu on the left
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    if($("#menu-toggle").text().trim() === "Open Menu"){
        $("#menu-toggle").text("Close Menu");

    }else{
        $("#menu-toggle").text("Open Menu");
    }

});
</script>

<style>
/*Gathering all the brute css at the end to clear things up*/

.tooltip2 {
  position: absolute;
  display: inline-block;
  margin-top: -6px;
}

.tooltip2 .tooltiptext2 {
visibility: hidden;
display : none;
line-height: 20px;
width: 300px;
background-color: #6d9ce8;
color: #fff;
text-align: center;
border-radius: 6px;
padding: 5px 0;
position: absolute;
z-index: 1;
top: 150%;
left: 50%;
margin-left: -140px;
}

.tooltip2 .tooltiptext2::after {
content: "";
position: absolute;
bottom: 100%;
left: 50%;
margin-left: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent transparent #6d9ce8 transparent;
}

.tooltip2:hover .tooltiptext2 {
visibility: visible;
display : inline-block;
}



.switch-toggle {
  width: 10em;
  margin-left: 20px;
}

.switch-toggle label:not(.disabled) {
  cursor: pointer;
}



#shed{
  color:white;
}

/* Days (1-31) */
.days {
  padding: 10px 0;
  background: #eee;
  margin: 0;
}

.days li {
  list-style-type: none;
  display: inline-block;
  width: 13.6%;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}

.days li:hover{

background: #1abc9c;
color: white !important
}

/* Highlight the "current" day */
.days li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

/*schedule atomizing*/
#shed2{
  color:white;
}

/* Days (1-31) */
.days2 {
  padding: 10px 0;
  background: #eee;
  margin: 0;
}

.days2 li {
  list-style-type: none;
  display: inline-block;
  width: 13.6%;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}

.days2 li:hover{

background: #1abc9c;
color: white !important
}

/* Highlight the "current" day */
.days2 li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

/*Loading message and icon*/
#loadingMessage{
  color: white;
}
.holds-the-iframe {
  background:url(img/gifacha.gif) center center no-repeat;
  background-size: 50px 50px;
 }

/* Popup container - can be anything you want */
.popup {
    position: relative;
    display: inline-block;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* The actual popup */
.popup .popuptext {
    visibility: hidden;
    width: 400px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
}

.popup2 {
    position: relative;
    display: inline-block;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* The actual popup */
.popup2 .popuptext2 {
    visibility: hidden;
    width: 400px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
}

/* Popup arrow */
.popup2 .popuptext2::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup2 .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn2 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn2 {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeIn2 {
    from {opacity: 0;}
    to {opacity:1 ;}
}
</style>
