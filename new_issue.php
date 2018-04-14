<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION)) {
      header("Location: login.php");
    }
  ?>

  <?php
    $username = $_SESSION['username'];
  ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Issue/Return a New Book </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="book_id">Book ID</label>
  				<input type="text" id="book_id" name="book_id" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="username"> Username of borrower / returner </label>
  				<input type="text" id="username" name="username" class="form-control">
  			</div>

        <div class="form-input">
           <label for="transaction">Choose type of transaction </label>
           <select class="form-control" id="transaction">
             <option>Book Issue</option>
             <option>Book Return</option>
           </select>
        </div>
  			<div class="form-input">
  				<input type="submit" name="submit" value="Find Book" class="btn btn-success">
  			</div>
  		</form>
      <?php
        require "common.php";
        require "config.php";
        if (isset($_POST['submit'])) {
          $connection = mysqli_connect($host, $username, $password);
  				$select_db = mysqli_select_db($connection, $dbname);

          $book_ID = $_POST['book_id'];
          $username = $_POST['username'];
          $branch_ID = $_SESSION['branch_ID'];
          $issue_date = 'NOW()';
          $due_date = 'DATE_ADD(NOW(), INTERVAL 60 DAY)';

          $sql = "INSERT INTO book_issues (book_ID, branch_ID, username, issue_date, due_date)".
                 "VALUES('$book_ID', '$branch_ID', '$username', '$issue_date', '$due_date');";
          echo $sql;
        }
      ?>
  		<div class="form-input">
  			<a href="staff_dashboard.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
  </body>
</html>
