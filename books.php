<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION['branch_ID'])) {
      header("Location: staff_login.php");
    }
  ?>

  <?php $username = $_SESSION['username'] ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Add New Book </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="book_id">Book ID &nbsp;<span style="color: red;">*</span></label>
  				<input type="text" id="book_id" name="book_id" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="book_name">Book Name</label>
  				<input type="text" id="book_name" name="book_name" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="book_author">Book Author</label>
  				<input type="text" id="book_author" name="book_author" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="num_copies">Number of Copies</label>
  				<input type="text" id="num_copies" name="num_copies" class="form-control">
  			</div>
  			<div class="form-input">
  				<input type="submit" name="submit" value="Update Records" class="btn btn-success">
  			</div>
        <div class="form-input">
          <?php
            require "common.php";
            require "config.php";
            if (isset($_POST['submit'])) {
              $connection = mysqli_connect($host, $username, $password);
      				$select_db = mysqli_select_db($connection, $dbname);

              $book_id = $_POST['book_id'];
              $book_name = $_POST['book_name'];
              $book_author = $_POST['book_author'];
              $num_copies = $_POST['num_copies'];
              $branch_id = $_SESSION['branch_ID'];

              $is_present_in_branch = "SELECT * FROM copies WHERE book_ID='$book_id' AND branch_ID='$branch_id';";
              $result = mysqli_query($connection, $is_present_in_branch);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              $is_present_global = "SELECT * from books WHERE book_ID='$book_id';";
              if ($row) {
                // Update the records
                $prev_copies = $row['num_copies'];
                $num_copies = $num_copies + $prev_copies;
                $sql = "UPDATE copies SET num_copies='$num_copies' WHERE book_ID='$book_id' AND branch_ID='$branch_id';";
                mysqli_query($connection, $sql);
                echo '<div class="alert alert-success">',
                        '<strong>Book was already present. </strong> Records updated.',
                      '</div>';
              } else {
                // add new entry
                $sql1 = "INSERT INTO copies VALUES ('$book_id', '$branch_id', '$num_copies');";
                $sql2 = "INSERT INTO books VALUES ('$book_id', '$book_name', '$book_author');";
                $result = mysqli_query($connection, $is_present_global);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (!$row) {
                  mysqli_query($connection, $sql2);
                  echo '<div class="alert alert-success">',
                          '<strong>New book added to global catalogue. </strong>',
                        '</div>';
                } else {
                  echo '<div class="alert alert-success">',
                          '<strong>New book added in this branch. </strong>',
                        '</div>';
                }
                mysqli_query($connection, $sql1);
              }
            }
          ?>
        </div>
  		</form>
  		<div class="form-input">
  			<a href="staff_dashboard.php" type="button" class="btn btn-success">Back to Dashboard</a>
  		</div>
  </body>
</html>
