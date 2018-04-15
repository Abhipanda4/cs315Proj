<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION['random'])) {
      header("Location: users_login.php");
    }
  ?>
  <?php $username = $_SESSION["username"]; ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> User Dashboard </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <div class="index-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="tile"> <a href="history.php" style="text-decoration: none; color: black;"> Check History </a> </div>
          </div>
          <div class="col-lg-12">
            <div class="tile"> <a href="catalogue.php" style="text-decoration: none; color: black;"> Check Catalogue </a> </div>
          </div>
          <div class="col-lg-12">
            <div class="tile"> <a href="edit_profile.php" style="text-decoration: none; color: black;"> Edit Profile </a> </div>
          </div>
        </div>
      </div>
	</div>
	    <?php include "logout.php"; ?>
  	<?php include "templates/footer.php"; ?>
  </body>
</html>
