<?php include "templates/header.php"; ?>

<?php
	if (isset($_SESSION)) {
	  header("Location: dashboard.php");
	}
?>

<body>
	<div class="container main-body">
		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
			<h2> Staff Login Page </h2>
		</div>

		<form method="post">
			<div class="form-input">
				<label for="username">Staff Name</label>
				<input type="text" id="username" name="username" class="form-control">
			</div>
      <div class="form-input">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
			<div class="form-input">
				<input type="submit" name="submit" value="Login" class="btn btn-success">
			</div>
		</form>
    <?php
      require "common.php";
      require "config.php";
      if (isset($_POST['submit'])) {
				// Connect to server and select databse.
				$connection = mysqli_connect($host, $username, $password);
				$select_db = mysqli_select_db($connection, $dbname);

        $username = escape($_POST['username']);
        $password = hash('sha256',escape($_POST["password"]));

				$sql = "SELECT * FROM staff WHERE username='$username'AND password='$password'";
				$result = mysqli_query($connection, $sql);
        $num_of_rows = mysqli_num_rows($result);
        if ($num_of_rows == 0) {
          // echo "Invalid Username or password!! Try Again....";
					echo '<div class="alert alert-danger col-md-10 col-md-offset-1">',
    							'<strong>Wrong Username or Password!</strong></a>',
  							'</div>';
        } else {
          session_start();
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $_SESSION['username'] = $username;
					$_SESSION['branch_ID'] = $row['branch_ID'];
          header("Location: staff_dashboard.php");
        }
      }
    ?>
    <p></p>
		<div class="form-input">
			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
		</div>

  </div>
<?php include "templates/footer.php"; ?>
