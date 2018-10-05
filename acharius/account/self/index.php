<?php

session_start();
include("https://www.achariuslab.com/action/checkSession.php");

include("../../include/header.php");
    include("../../include/nav.php");

     ?>
    <!-- Page Content -->
    <div class="container">

      <?php

      try
      {
        $bdd = new PDO('mysql:host=jeschbacplbdd.mysql.db;dbname=jeschbacplbdd;charset=utf8', 'jeschbacplbdd', 'Jules1234FTP');
      }
      catch(Exception $e)
      {
        die('Erreur : '.$e->getMessage());
      }

      $infouser = $bdd->prepare('SELECT * FROM acharius_account WHERE id = :id');
      $infouser->execute(array(
        'id' => $_SESSION['id']
      ));

      if($infouser->rowCount() > 0){
        $data = $infouser->fetch();
        $fname = $data['fname'];
        $lname = $data['lname'];
        $username = $data['username'];
        $email = $data['email'];
        $bday = $data['birth'];
      }

      ?>

    <br/><br/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="" class="list-group-item list-group-item-action active">My infos</a>
              <a href="advanced.php" class="list-group-item list-group-item-action">Advanced settings</a>


            </div>
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="updateInfo.php">
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">User Name</label>
                                <div class="col-8">
                                  <input id="username" name="username" value="<?php echo $username;?>" placeholder="Username" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">First Name</label>
                                <div class="col-8">
                                  <input id="name" name="name" value="<?php echo $fname;?>" placeholder="First Name" class="form-control here" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="lastname" class="col-4 col-form-label">Last Name</label>
                                <div class="col-8">
                                  <input id="lastname" name="lastname" value="<?php echo $lname;?>" placeholder="Last Name" class="form-control here" type="text">
                                </div>
                              </div>


                              <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                  <input id="email" name="email" value="<?php echo $email;?>" placeholder="Email" class="form-control here" required="required" type="text">
                                </div>
                              </div>

                              <div class="form-group row" style="display:none;">
                                <label for="id" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                  <input id="id" name="id" value="<?php echo $_SESSION['id'];?>" placeholder="Email" class="form-control here" required="required" type="hidden">
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="newpass" class="col-4 col-form-label">New Password</label>
                                <div class="col-8">
                                  <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="password">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="newpass" class="col-4 col-form-label">Birthday</label>
                                <div class="col-8">
                                  <input id="bday" name="bday" value="<?php echo $bday;?>" placeholder="Birthday" class="form-control here" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
                                </div>
                              </div>
                            </form>
		                </div>
		            </div>

		        </div>
		    </div>
		</div>
	</div>
</div>

</div><br/><br/><br/><br/>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Acharius Lab 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
