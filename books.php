<!doctype html>
<html lang="en">

  <?php include "templates/header.php"; ?>
  <?php
    session_start();
    if (!isset($_SESSION)) {
      header("Location: login.php");
    }
  ?>

  <?php $username = $_SESSION['username'] ?>
  <body>
  	<div class="container main-body">
  		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
  			<h2> Add or Remove a Book </h2>
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
  				<input type="submit" name="submit" value="Find Book" class="btn btn-success">
  			</div>
  		</form>
  		<div class="form-input">
  			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
  		</div>
  </body>
</html>
