<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION['branch_ID'])) {
      header("Location: staff_login.php");
    }
  ?>
  <?php $user = $_SESSION["username"]; ?>
     <body>
        <div class="container main-body">
                <div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
                        <h2> Staff List </h2>
                </div>
      <div class="welcome-msg"> Welcome, <?php echo $user; ?> </div>
      <form method="post">
        <div class="form-input">
           <label for="transaction">Enter Branch ID</label>
           <input class="form-control" id="transaction" name="transaction" class="form-control">
        </div>
                        <div class="form-input">
                                <input type="submit" name="submit" value="Find Staff" class="btn btn-success">
                        </div>
                </form>
      <div class="form-input">
      <?php
        require "common.php";
        require "config.php";
        if (isset($_POST['submit'])) {
          $connection = new PDO($dsn, $username, $password, $options);
//          $connection = mysqli_connect($host, $username, $password);
//                               $select_db = mysqli_select_db($connection, $dbname);

	  $id = $_POST['transaction'];
		$sql = "SELECT * FROM staff WHERE branch_ID = :id";
		$statement = $connection->prepare($sql);
          	$statement->bindParam(':id', $id, PDO::PARAM_STR);
          	$statement->execute();
          	$result = $statement->fetchAll();




        }

      ?>

<?php
	        if (isset($_POST['submit'])) {
			        if ($result) { ?>
					                <h3>Results</h3>

                <table class="table">
                        <thead>
				                 <tr>
                          <th>Branch ID</th>
                          <th>Staff Name</th>
                        </tr>
                        </thead>
                        <tbody>
<?php           foreach ($result as $row) { ?>
                        <tr>
                                <td><?php echo escape($_POST['transaction']); ?> </td>
                                <td><?php echo escape($row["username"]); ?> </td>
                        </tr>
                <?php } ?>
                        </tbody>
                </table>
        <?php } else    { ?>
                        <blockquote>No results found for branch ID <?php echo escape($_POST['transaction']); ?>.</blockquote>
<?php   }
}?>
</div>

  		<div class="form-input">
  			<a href="staff_dashboard.php" type="button" class="btn btn-success">Back to dashboard</a>
		</div>

  </body>
</html>
