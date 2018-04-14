<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION)) {
      header("Location: users_login.php");
    }
  ?>
  <?php $username = $_SESSION["username"]; ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Check Earlier Transactions </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="from_date">From date</label>
  				<input type="date" id="from_date" name="from_date" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="to_date">To date</label>
  				<input type="date" id="to_date" name="to_date" class="form-control">
  			</div>
  			<div class="form-input">
  				<input type="submit" name="submit" value="Find Transactions" class="btn btn-success">
  			</div>
  		</form>
      <?php
        require "common.php";
        require "config.php";
        if (isset($_POST['submit'])) {
          // Connect to server and select databse.
          $connection = mysqli_connect($host, $username, $password);
          $select_db = mysqli_select_db($connection, $dbname);

          $from_date = escape($_POST['from_date']);
          $to_date = escape($_POST["to_date"]);

          $sql = "SELECT * FROM issues WHERE name='$username'AND password='$password'";
          $result = mysqli_query($connection, $sql);
        }
      ?>
  		<div class="form-input">
  			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
  </body>
</html>
