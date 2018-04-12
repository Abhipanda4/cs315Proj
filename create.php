<?php include "templates/header.php"; ?>
<?php if (isset($_POST['submit'])) {
	require "common.php";
  require "config.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    // insert new user code will go here

    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $error->getMessage();
  }
} ?>


<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>

<div class="container main-body">
	<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
		<h2> Register a New User </h2>
	</div>
	<form method="post">
		<div class="form-input">
			<label for="firstname">First Name</label>
			<input type="text" name="firstname" id="firstname" class="form-control">
		</div>
		<div class="form-input">
			<label for="lastname">Last Name</label>
			<input type="text" name="lastname" id="lastname" class="form-control">
		</div>
		<div class="form-input">
			<label for="email">Email Address</label>
			<input type="text" name="email" id="email" class="form-control">
		</div>
		<div class="form-input">
			<label for="age">Age</label>
			<input type="text" name="age" id="age" class="form-control">
		</div>
		<div class="form-input">
			<label for="location">Location</label>
			<input type="text" name="location" id="location" class="form-control">
		</div>
		<div class="form-input">
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
		</div>
	</form>
	<div class="form-input">
		<a href="index.php" type="button" class="btn btn-success">Back to home</a>
	</div>
</div>
<?php include "templates/footer.php"; ?>
