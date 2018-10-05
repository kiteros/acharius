

<?php

if(isset($_COOKIE['user'])){
  //connect with them

  header('Location: login/connect.php?email=' . $_COOKIE['user'] . "&password=" . $_COOKIE['pass'] . "&direct=1");
}

 ?>




  <script>
    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
      console.log('statusChangeCallback');
      console.log(response);
      // The response object is returned with a status field that lets the
      // app know the current login status of the person.
      // Full docs on the response object can be found in the documentation
      // for FB.getLoginStatus().
      if (response.status === 'connected') {
        // Logged into your app and Facebook.
        testAPI();
      } else {
        // The person is not logged into your app or we are unable to tell.

      }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
    }

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '471159840045997',
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.8' // use graph api version 2.8
      });

      // Now that we've initialized the JavaScript SDK, we call
      // FB.getLoginStatus().  This function gets the state of the
      // person visiting this page and can return one of three states to
      // the callback you provide.  They can be:
      //
      // 1. Logged into your app ('connected')
      // 2. Logged into Facebook, but not your app ('not_authorized')
      // 3. Not logged into Facebook and can't tell if they are logged into
      //    your app or not.
      //
      // These three cases are handled in the callback function.

      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me?fields=email,name', function(response) {
 			 console.log(JSON.stringify(response));
        console.log('Successful login for: ' + response.name);
 			 var username = response.name.split(" ")[0] + response.name.split(" ")[1];
 			 var email = response.email;
        window.location.href="signup/redirectFB.php?facebook=1&username=" + username
 			 + "&email=" + email + "&fname=" + response.name.split(" ")[0] + "&lname="
 			 + response.name.split(" ")[1] + "&id=" + response.id;
      });
    }
  </script>

<!DOCTYPE html>
<html lang="en">

  <head>
    <script>
    if (location.protocol != 'https:')
    {
     location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    }
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="https://achariuslab.com/img/logo/rond_small.png">

    <title>Acharius Lab</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grayscale.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">AchariusLab</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login/.php" style="color: violet">AchariusLive</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login/index.php" style="color: orange">AchariusLesson</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="login/index.php">Log in</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">AchariusLab</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">- a new way to grow food -</h2>
          <a href="signup/index.php" class="btn btn-primary js-scroll-trigger">Sign up</a><br/>
          <br/><p style="color:white">- Or -</p>
          <div class="fb-login-button" data-max-rows="1" data-size="large"
          data-button-type="login_with" data-show-faces="false"
           data-auto-logout-link="false" data-use-continue-as="false"></div>
        </div>
      </div>
    </header>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-white mb-4">Our goal</h2>
            <p class="text-white-50">AchariusLab wants to provide a new way to grow food by using new technology. We want to simplify the food growing process by giving the user a total control of the plant.</p>
          </div>
        </div>
        <img src="img/logo/biglogo.png" class="img-fluid" alt="" width="500px">
      </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects-section bg-light">
      <div class="container">

        <!-- Featured Project Row -->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
          <div class="col-xl-8 col-lg-7">
            <img class="img-fluid mb-3 mb-lg-0" src="img/achafond2.jpg" alt="">
          </div>
          <div class="col-xl-4 col-lg-5">
            <div class="featured-text text-center text-lg-left">
              <h4>AchariusLive</h4>
              <p class="text-black-50 mb-0">Acharius Lab is developing a live streaming platform for our users around the world.
              You can now buy a personal plot where you can control everything to grow your plant.</p>
            </div>
          </div>
        </div>


        <!-- Project Two Row -->
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-6">
            <img class="img-fluid" src="img/achafond.png" alt="">
          </div>
          <div class="col-lg-6 order-lg-first">
            <div class="bg-black text-center h-100 project">
              <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-right">
                  <h4 class="text-white">How does it work?</h4>
                  <p class="mb-0 text-white-50">Grow your plant in an airtigh system connected to your computer. With AchariusLab, you can see the different steps of the growth process of your plant in real time. You also have the possibility to modify the settings, from watering to lighting.</p>
                  <hr class="d-none d-lg-block mb-0 mr-0">
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Subscribe to receive updates!</h2>

            <form class="form-inline d-flex" method="post" action="mails/addemail.php">
              <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address..." name="email">
              <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
            </form>

          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50">Somewhere between Switzerland and France</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="mailto:contact@achariuslab.com?Subject=Help">contact@achariuslab.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">Prefer email</div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="https://twitter.com/AchariusLab" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; AchariusLab 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/font-awesome/js/all.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>

  </body>

</html>
