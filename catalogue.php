<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION)) {
      header("Location: users_login.php");
    }
  ?>
  <?php $user = $_SESSION["username"]; ?>
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
                        <h2> Catalogue </h2>
                </div>
      <div class="welcome-msg"> Welcome, <?php echo $user; ?> </div>
      <form method="post">
        <div class="form-input">
           <label for="transaction">Enter Branch ID</label>
           <input class="form-control" id="transaction" name="transaction" class="form-control">
        </div>
                        <div class="form-input">
                                <input type="submit" name="submit" value="Find Book" class="btn btn-success">
                        </div>
                </form>
      <?php
        require "common.php";
        require "config.php";
        if (isset($_POST['submit'])) {
          $connection = new PDO($dsn, $username, $password, $options);
//          $connection = mysqli_connect($host, $username, $password);
//                               $select_db = mysqli_select_db($connection, $dbname);

	  $id = $_POST['transaction'];
		$sql = "SELECT * FROM copies NATURAL JOIN books NATURAL JOIN branches WHERE branch_ID = :id";
		$statement = $connection->prepare($sql);
          	$statement->bindParam(':id', $id, PDO::PARAM_STR);
          	$statement->execute();
          	$result = $statement->fetchAll();




        }

      ?>

<?php
	        if (isset($_POST['submit'])) {
			        if ($result) { ?>
					                <h2>Results</h2>

                <table>
                        <thead>
				<tr>
                                        <th>Book ID</th>
					<th>Book Name </th>
					<th>Branch ID</th>
                                        <th>Branch Address</th>
                                        <th>#Copies</th>
                                </tr>
                        </thead>
                        <tbody>
<?php           foreach ($result as $row) { ?>
                        <tr>
                                <td><?php echo escape($row["book_ID"]); ?> </td>
                                <td><?php echo escape($row["book_name"]); ?> </td>
                                <td><?php echo escape($row["branch_ID"]); ?> </td>
                                <td><?php echo escape($row["address"]); ?> </td>
                                <td><?php echo escape($row["num_copies"]); ?> </td>
                        </tr>
                <?php } ?>
                        </tbody>
                </table>
        <?php } else    { ?>
                        <blockquote>No results found for branch ID <?php echo escape($_POST['transaction']); ?>.</blockquote>
<?php   }
}?>

  		<div class="form-input">
  			<a href="dashboard.php" type="button" class="btn btn-success">Back to dashboard</a>
		</div>

  </body>
</html>
