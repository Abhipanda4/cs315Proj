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
  			<h2> Staff Dashboard </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="tile"> <a href="books.php" style="text-decoration: none; color: black;"> Add New Books </a> </div>
        </div>
        <div class="col-sm-6">
          <div class="tile"> <a href="issue_or_borrow.php" style="text-decoration: none; color: black;"> Manage Book Issues </a> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="tile"> <a href="staff_list.php" style="text-decoration: none; color: black;"> List all Staff </a> </div>
        </div>
        <div class="col-sm-6">
          <div class="tile"> <a href="add_staff.php" style="text-decoration: none; color: black;"> Add New Staff </a> </div>
        </div>
      </div>
  	</div>
    <?php include "logout.php"; ?>
  	<?php include "templates/footer.php"; ?>
  </body>
</html>
