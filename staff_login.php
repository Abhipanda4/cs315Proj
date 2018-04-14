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
				<label for="staff_ID">Staff ID</label>
				<input type="text" id="staff_ID" name="staff_ID" class="form-control">
			</div>
      <div class="form-input">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
			<div class="form-input">
				<input type="submit" name="submit" value="Login" class="btn btn-success">
			</div>
		</form>
		<div class="form-input">
			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
		</div>

    <?php
      require "common.php";
      require "config.php";
      if (isset($_POST['submit'])) {
        try {
          $connection = new PDO($dsn, $staff_ID, $password, $options);

          $staff_ID = escape($_POST['staff_ID']);
          $password = hash('sha256',escape($_POST["password"]));
					// echo $staff_ID;
					// echo $password;
          // $sql = "SELECT * FROM users WHERE firstname = ? AND password = ?";

					$sql = "SELECT * FROM staff WHERE staff_ID='$staff_ID'AND password='$password'";
					echo $sql;

          $statement = $connection->prepare($sql);
          // $statement->bind_params("ss", $staff_ID, $password);
          $statement->execute();
          $result = $statement->get_result();
          $num_of_rows = $result->num_rows;
          if ($num_of_rows == 0) {
            echo "Invalid staff_ID or password!! Try Again....";
          } else {
            session_start();
            $_SESSION['staff_ID'] = $staff_ID;
            header("Location: dashboard.php");
          }
          $statement->close();
        } catch(PDOException $error) {
          echo $error->getMessage();
        }
      }
    ?>
  </div>
<?php include "templates/footer.php"; ?>
