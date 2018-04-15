<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION['branch_ID'])) {
      header("Location: staff_login.php");
    }
  ?>
  <?php $username = $_SESSION['username']; ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Choose Action </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="tile"> <a href="new_issue.php" style="text-decoration: none; color: black;"> Issue a New Book </a> </div>
        </div>
        <div class="col-sm-6">
          <div class="tile"> <a href="return.php" style="text-decoration: none; color: black;"> Return a Borrowed Book </a> </div>
        </div>
      </div>
  	</div>
  	<?php include "templates/footer.php"; ?>
  </body>
</html>
