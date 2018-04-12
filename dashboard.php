<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    // if (!isset($_SESSION)) {
    //   header("Location: login.php");
    // }
  ?>
  <?php $username="chutiya"; ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> User Dashboard </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="tile"> <a href="new_issue.php" style="text-decoration: none; color: black;"> Borrow New Book </a> </div>
        </div>
        <div class="col-sm-6">
          <div class="tile"> <a href="history.php" style="text-decoration: none; color: black;"> Check History </a> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="tile"> <a href="catalogue.php" style="text-decoration: none; color: black;"> Check Catalogue </a> </div>
        </div>
        <div class="col-sm-6">
          <div class="tile"> <a href="complaint.php" style="text-decoration: none; color: black;"> Issue Complaint </a> </div>
        </div>
      </div>
  	</div>
  	<?php include "templates/footer.php"; ?>
  </body>
</html>
