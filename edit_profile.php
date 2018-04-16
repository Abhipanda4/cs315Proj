<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
  session_start();
  if (!isset($_SESSION['random'])) {
    header("Location: users_login.php");
  }
  ?>
  <?php $user = $_SESSION["username"]; ?>
     <body>
        <div class="container main-body">
                <div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
                        <h2> Check Your Transactions</h2>
                </div>
      <div class="welcome-msg"> Welcome, <?php echo $user; ?> </div>
      <form method="post">
  		<div class="form-input">
  			<label for="name">Name</label>
  			<input type="text" name="name" id="name" class="form-control">
  		</div>
  		<div class="form-input">
  			<label for="password">New Password (Same as old if you do not want to change!)</label>
  			<input type="password" name="password" id="password" class="form-control">
  		</div>
  		<div class="form-input">
  			<label for="email">Email Address</label>
  			<input type="text" name="email" id="email" class="form-control">
  		</div>
  		<div class="form-input">
  			<label for="location">Location</label>
  			<input type="text" name="location" id="location" class="form-control">
  		</div>
  		<div class="form-input">
  			<input type="submit" name="submit" value="Submit" class="btn btn-success">
  		</div>
	</form>
	<?php
        require "common.php";
        require "config.php";
        if (isset($_POST['submit'])) {
          $connection = new PDO($dsn, $username, $password, $options);
          if ($_POST['password'] == "") {
            echo '<div class="alert alert-danger col-md-10 col-md-offset-1">',
          	        '<strong>Password cannot be empty. </strong></a>',
                		'</div>';
          } else {
        		$new_password = hash('sha256',escape($_POST["password"]));
        		$email  =  $_POST["email"];
        		$location = $_POST["location"];
        		$name = $_POST["name"];
                        $sql = "UPDATE users
        			SET name = :name, username = :user, email = :email, password = :new_password, location = :location
        			WHERE username = :user";
                        $statement = $connection->prepare($sql);
                        $statement->bindParam(':user', $user, PDO::PARAM_STR);
        		$statement->bindParam(':name', $name, PDO::PARAM_STR);
                        $statement->bindParam(':email', $email, PDO::PARAM_STR);
                        $statement->bindParam(':new_password', $new_password, PDO::PARAM_STR);
                        $statement->bindParam(':location', $location, PDO::PARAM_STR);
                        $statement->execute();
        	  if ($statement->rowCount() ? true : false) {
             		 echo '<div class="alert alert-success col-md-10 col-md-offset-1">',
                      		'<strong>Profile successfully updated.</strong>',
                    		'</div>';
            			} else {
              		echo '<div class="alert alert-danger col-md-10 col-md-offset-1">',
                	        '<strong>That did not work! Did you write your old password correctly ??</strong></a>',
                      		'</div>';
            			}
          }
        }

      ?>


  		<div class="form-input">
  			<a href="dashboard.php" type="button" class="btn btn-success">Back to dashboard</a>
		</div>

  </body>
</html>
