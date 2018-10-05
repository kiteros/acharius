<?php

if(isset($_GET['er'])){
	if($_GET['er'] == 0){
		?>
		<script>
			alert("wrong password");
		</script>
		<?php
	}else if($_GET['er'] == 1){
		?>
		<script>
			alert("user does not exists");
		</script>
		<?php
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Login - AchariusLab</title>
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
		<h1>Log in to AchariusLab</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="connect.php" method="get">
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<div class="wthree-text">
						<div class="clear"> </div>
					</div>
					<input type="submit" value="Log in">
				</form>
				<p>Don't have an Account? <a href="../signup/index.php"> Sign up Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<br/><br/><br/><br/><br/><br/>
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
