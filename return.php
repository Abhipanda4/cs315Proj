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
  			<h2> Return Borrowed Book </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="issue_id">Issue ID</label>
  				<input type="text" id="issue_id" name="issue_id" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="book_id">Book ID</label>
  				<input type="text" id="book_id" name="book_id" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="username"> Username of returner </label>
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

              $issue_ID = $_POST['issue_id'];
              $book_ID = $_POST['book_id'];
              $username = $_POST['username'];
              $branch_ID = $_SESSION['branch_ID'];
              $quantity = $_POST['quantity'];

              $check = "SELECT num_copies FROM copies WHERE book_ID='$book_ID' AND branch_ID='$branch_ID';";
              $copies = mysqli_query($connection, $check);
              $row = mysqli_fetch_array($copies, MYSQLI_ASSOC);
              $num_copies = 0;
              if ($row) {
                $num_copies = $row['num_copies'];
              }

              $check = "SELECT * FROM book_issues WHERE issue_ID='$issue_ID';";
              $result = mysqli_query($connection, $check);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              if ($row) {
                $book_borrowed = $row['book_ID'];
                $borrower = $row['username'];
                $return_date = $row['return_date'];
                if ($borrower != $username) {
                  echo '<div class="alert alert-danger">',
                          '<strong>The books were issued by a different user: '.$borrower .'</strong>',
                        '</div>';
                } else if ($book_borrowed != $book_ID) {
                  echo '<div class="alert alert-danger">',
                          '<strong>The books issued were of different ID: '.$book_borrowed .'</strong>',
                        '</div>';
                } else if ($return_date != NULL) {
                  echo '<div class="alert alert-danger">',
                          '<strong>The books have already been returned.</strong>',
                        '</div>';
                } else {
                  $num_borrowed = $row['num_copies'];
                  if ($quantity == $num_borrowed) {
                    $sql = "UPDATE book_issues ".
                           "SET num_copies=0, return_date=NOW() ".
                           "WHERE issue_ID='$issue_ID';";
                    $result = mysqli_query($connection, $sql);
                    if ($result) {
                      echo '<div class="alert alert-success">',
                              '<strong>Successfully Returned.</strong>',
                            '</div>';
                      $new= $num_copies + $quantity;
                      $update = "UPDATE copies SET num_copies='$new' WHERE book_ID='$book_ID' AND branch_ID='$branch_ID';";
                      mysqli_query($connection, $update);
                    } else {
                      echo '<div class="alert alert-danger">',
                              '<strong>Something went wrong!</strong> Perhaps user is not registered or invalid book ID.</a>',
                            '</div>';
                    }
                  } else {
                        echo '<div class="alert alert-warning">',
                            '<strong>You have to return '. $num_borrowed .' copies!</strong></a>',
                          '</div>';
                  }
                }
              } else {
                echo '<div class="alert alert-danger">',
                        '<strong>Something went wrong!</strong> Perhaps user is not registered or invalid book ID.</a>',
                      '</div>';
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
