<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    // if (!isset($_SESSION)) {
    //   header("Location: login.php");
    // }
  ?>

  <body>
    <div class="container main-body">
      <div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
        <h2> Catalogue </h2>
      </div>
      <form method="post">
  			<div class="form-input">
  				<label for="location">Branch ID</label>
  				<input type="text" id="location" name="location" class="form-control">
  			</div>
        <div class="form-input">
  				<input type="submit" name="submit" value="View Catalogue" class="btn btn-success">
  			</div>
  		</form>
  		<div class="form-input">
  			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
    </div>
  </body>
