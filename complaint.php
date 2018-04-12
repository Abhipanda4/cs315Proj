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
  			<h2> Issue a New Complaint </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="complaint">Complaint</label>
  				<input type="text" id="complaint" name="complaint" class="form-control">
  			</div>
  			<div class="form-input">
  				<input type="submit" name="submit" value="Lodge Complaint" class="btn btn-success">
  			</div>
  		</form>
  		<div class="form-input">
  			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
  </body>
</html>
