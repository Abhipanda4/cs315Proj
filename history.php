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
      <div class="welcome-msg"> Welcome, <?php echo $user; ?> </div>
      <form method="post">
        <div class="form-input">
           <label for="transaction">Choose type of transaction </label>
           <select class="form-control" id="transaction" name="transaction">
               <option>Overdue Issues</option>
               <option>Due Issues</option>
  	           <option>Cleared Issues</option>
            </select>
            <?php
              require "common.php";
              require "config.php";
              if (isset($_POST['submit'])) {
                $connection = new PDO($dsn, $username, $password, $options);
      //          $connection = mysqli_connect($host, $username, $password);
      //                               $select_db = mysqli_select_db($connection, $dbname);
      	   $now = 'NOW()';
                if($_POST['transaction'] == 'Cleared Issues'){
      		$sql = "SELECT * FROM book_issues NATURAL JOIN books NATURAL JOIN branches WHERE username = :user AND return_date IS NOT NULL";
      		$statement = $connection->prepare($sql);
                	$statement->bindParam(':user', $user, PDO::PARAM_STR);
                	$statement->execute();
                	$result = $statement->fetchAll();
      }

      	else if($_POST['transaction'] == 'Overdue Issues'){
                      $sql = "SELECT * FROM book_issues NATURAL JOIN books NATURAL JOIN branches WHERE username = :user AND return_date IS NULL AND due_date <= NOW()";
                      $statement = $connection->prepare($sql);
                      $statement->bindParam(':user', $user, PDO::PARAM_STR);
                      $statement->execute();
                      $result = $statement->fetchAll();
      }
      	else if($_POST['transaction'] == 'Due Issues'){
                      $sql = "SELECT * FROM book_issues NATURAL JOIN books NATURAL JOIN branches WHERE username = :user  AND return_date IS NULL AND  due_date > NOW()";
                      $statement = $connection->prepare($sql);
                      $statement->bindParam(':user', $user, PDO::PARAM_STR);
                      $statement->execute();
                      $result = $statement->fetchAll();
      }


              }

            ?>

      <?php
      	        if (isset($_POST['submit'])) {
      			        if ($result) { ?>
      					                <h2>Results</h2>

                      <table class="table">
                              <thead>
                                      <tr>
                                              <th>Book</th>
                                              <th>Branch </th>
                                              <th>Issue Date</th>
                                              <th>Due Date</th>
                                              <th>Return Date</th>
                                      </tr>
                              </thead>
                              <tbody>
      <?php           foreach ($result as $row) { ?>
                              <tr>
                                      <td><?php echo escape($row["book_name"]); ?> </td>
                                      <td><?php echo escape($row["address"]); ?> </td>
                                      <td><?php echo escape($row["issue_date"]); ?> </td>
                                      <td><?php echo escape($row["due_date"]); ?> </td>
                                      <td><?php echo escape($row["return_date"]); ?> </td>
                              </tr>
                      <?php } ?>
                              </tbody>
                      </table>
              <?php } else    { ?>
                              <blockquote>No results found for <?php echo escape($_POST['transaction']); ?>.</blockquote>
      <?php   }
      }?>
        </div>
        <div class="form-input">
                <input type="submit" name="submit" value="Find Book" class="btn btn-success">
        </div>
      </form>


  		<div class="form-input">
  			<a href="dashboard.php" type="button" class="btn btn-success">Back to dashboard</a>
		</div>

  </body>
</html>
