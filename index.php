<!doctype html>
<html lang="en">

<?php include "templates/header.php"; ?>
<?php
	if (isset($_SESSION)) {
	  header("Location: dashboard.php");
	}
?>

<body>
	<div class="container main-body">
		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
			<h2> LIBRARY MANAGEMENT SYSTEM </h2>
		</div>
		<div class="index-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="tile"> <a href="create.php" style="text-decoration: none; color: black;"> Register a New User </a> </div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="tile"> <a href="read.php" style="text-decoration: none; color: black;"> Search Users </a> </div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="tile"> <a href="login.php" style="text-decoration: none; color: black;"> User Login </a> </div>
				</div>
			</div>
		</div>
	</div>
	<?php include "templates/footer.php"; ?>

</body>
</html>
