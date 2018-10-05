<?php
$redirectFriend = false;
if(isset($_GET['d'])){
	//login redirect to buy parcel
	$redirectFriend = true;
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
       window.location.href="create_account.php?facebook=1&username=" + username
			 + "&email=" + email + "&fname=" + response.name.split(" ")[0] + "&lname="
			 + response.name.split(" ")[1] + "&id=" + response.id;
     });
   }
 </script>


<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Signup - AchariusLab</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Bubble SignUp Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="https://achariuslab.com/img/logo/rond_small.png">
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>SignUp to AchariusLab</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">

				<form action="create_account.php
				<?php if($redirectFriend){
					echo "?redirect=friend";
				}?>" method="get">
					<input class="text" type="text" name="fname" placeholder="First name" required="">
					<input class="text email" type="text" name="lname" placeholder="Last name" required="">
					<input class="text" type="text" name="username" placeholder="Username" required="">
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<input class="text w3lpass" type="password" name="password" placeholder="Confirm Password" required="">
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions <a href="terms.php">see</a></span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGNUP">
				</form>
				<p>Already have an account? <a href="../login/index.php"> Log in Now!</a></p>
				<fb:login-button
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>
			</div>
		</div>
		<!-- copyright -->
		<div class="w3copyright-agile">
			<p>© 2018 Acharius Lab</p>
		</div>
		<!-- //copyright -->
		<ul class="w3lsg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>
