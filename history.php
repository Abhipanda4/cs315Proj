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
<!--  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Check Your Transactions </h2>
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
		</form>  -->
     <body>
        <div class="container main-body">
                <div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
                        <h2> Check Your Transactions</h2>
                </div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <div class="index-body">
      <form method="post">
        <div class="row">
          <div class="col-lg-12">
           <div class="tile"><input type="submit" name="overdue" value="Overdue Issues"></div>
          </div>
          <div class="col-lg-12">
	  <div class="tile"><input type="submit" name="due" value="Due Issues"></div>
	  </div>
          <div class="col-lg-12">
	  <div class="tile"><input type="submit" name="cleared" value="Cleared Issues"></div>
          </div>
        </div>
      </form>
      </div>
        </div>
        <?php include "templates/footer.php"; ?>

      <?php
        require "common.php";
        require "config.php";
        if (isset($_POST['due'])) {
          // Connect to server and select databse.
          $connection = mysqli_connect($host, $username, $password);
          $select_db = mysqli_select_db($connection, $dbname);
          echo $sql;
          $sql = "SELECT * FROM issues WHERE username='$username'";
	  $result = mysqli_query($connection, $sql);
	  echo $result;
	}
	else{
		echo "wtf";
	}
?>
<?php
	        if (isset($_POST['due'])) {
			        if ($result && $statement->rowCount() > 0) { ?>
					                <h2>Results</h2>

                <table>
                        <thead>
                                <tr>
                                        <th>Name</th>
                                        <th>userame</th>
                                        <th>Email Address</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                </tr>
                        </thead>
                        <tbody>
<?php           foreach ($result as $row) { ?>
                        <tr>
                                <td><?php echo escape($row["name"]); ?></td>
                                <td><?php echo escape($row["username"]); ?></td>
                                <td><?php echo escape($row["email"]); ?></td>
                                <td><?php echo escape($row["location"]); ?></td>
                                <td><?php echo escape($row["date"]); ?> </td>
                        </tr>
                <?php } ?>
                        </tbody>
                </table>
        <?php } else    { ?>
                        <blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
<?php   }
}?>

  		<div class="form-input">
  			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
  </body>
</html>
