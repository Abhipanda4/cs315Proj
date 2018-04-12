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
  			<h2> Check Earlier Transactions </h2>
  		</div>
      <div class="welcome-msg"> Welcome, <?php echo $username; ?> </div>
      <form method="post">
  			<div class="form-input">
  				<label for="from_date">From date</label>
  				<input type="date" id="from_date" name="from_date" class="form-control">
  			</div>
        <div class="form-input">
  				<label for="to_date">To date</label>
  				<input type="date" id="to_date" name="to_date" class="form-control">
  			</div>
  			<div class="form-input">
  				<input type="submit" name="submit" value="Find Transactions" class="btn btn-success">
  			</div>
  		</form>
  		<div class="form-input">
  			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
  </body>
</html>
