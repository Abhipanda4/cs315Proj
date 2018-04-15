<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION['branch_ID'])) {
      header("Location: staff_login.php");
    }
  ?>

  <?php
    $username = $_SESSION['username'];
  ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Issue a New Book </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="book_id">Book ID</label>
  				<input type="text" id="book_id" name="book_id" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="username"> Username of borrower </label>
  				<input type="text" id="username" name="username" class="form-control">
  			</div>
  			<div class="form-input">
          <div class="form-group">
            <label for="quantity">Number of books</label>
            <select name="quantity" class="form-control" id="quantity">
              <option>1</option>
              <option>2</option>
              <option>3</option>
            </select>
          </div>
  			</div>
    		<div class="form-input">
    			<input type="submit" name="submit" value="Submit" class="btn btn-success">
    		</div>
  			<div class="form-input">
          <?php
            require "common.php";
            require "config.php";
            if (isset($_POST['submit'])) {
              $connection = mysqli_connect($host, $username, $password);
      				$select_db = mysqli_select_db($connection, $dbname);

              $book_ID = $_POST['book_id'];
              $username = $_POST['username'];
              $branch_ID = $_SESSION['branch_ID'];
              $quantity = $_POST['quantity'];

              // check if the book is available in the branch
              $check = "SELECT num_copies FROM copies WHERE book_ID='$book_ID' AND branch_ID='$branch_ID';";
              $copies = mysqli_query($connection, $check);
              $row = mysqli_fetch_array($copies, MYSQLI_ASSOC);
              $num_copies = 0;
              if ($row) {
                $num_copies = $row['num_copies'];
              }
              if ($num_copies > $quantity) {
                $sql = "INSERT INTO book_issues (book_ID, branch_ID, username, num_copies, issue_date, due_date) ".
                       "VALUES('$book_ID', '$branch_ID', '$username', '$quantity', NOW(), DATE_ADD(NOW(), INTERVAL 60 DAY));";
                $result = mysqli_query($connection, $sql);
                if ($result) {
                  $check = "SELECT MAX(issue_ID) FROM book_issues;";
                  $issue_num = mysqli_query($connection, $check);
                  $display = mysqli_fetch_array($issue_num)[0];
                  echo '<div class="alert alert-success">',
                          '<strong>Your issue ID is: '. $display .'. </strong>',
                        'Please remember it for returning</div>';
                  $diff = $num_copies - $quantity;
                  $update = "UPDATE copies SET num_copies='$diff' WHERE book_ID='$book_ID' AND branch_ID='$branch_ID';";
                  mysqli_query($connection, $update);
                } else {
                  echo '<div class="alert alert-danger">',
                          '<strong>Something went wrong!</strong> Perhaps user is not registered or invalid book ID.</a>',
                        '</div>';
                }
              } else {
                  if ($num_copies == 0) {
                    echo '<div class="alert alert-warning">',
                        '<strong>The book is currently unavailable! Please come back later.</strong></a>',
                      '</div>';
                    } else {
                      echo '<div class="alert alert-warning">',
                          '<strong>Only '.$num_copies.' books are available!</strong></a>',
                        '</div>';
                    }
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
