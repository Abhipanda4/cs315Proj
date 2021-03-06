<?php include "templates/header.php"; ?>




<div class="container main-body">
	<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
		<h2> Register a New User </h2>
	</div>
	<form method="post">
		<div class="form-input">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control">
		</div>
		<div class="form-input">
			<label for="username">User Name</label>
			<input type="text" name="username" id="username" class="form-control">
		</div>
		<div class="form-input">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control">
		</div>
		<div class="form-input">
			<label for="email">Email Address</label>
			<input type="text" name="email" id="email" class="form-control">
		</div>
		<div class="form-input">
			<label for="location">Location</label>
			<input type="text" name="location" id="location" class="form-control">
		</div>
		<div class="form-input">
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
		</div>
		<div class="form-input">
		<?php if (isset($_POST['submit'])) {
			require "common.php";
		  require "config.php";
			if ($_POST['username'] == "" or $_POST['password'] == "") {
				echo '<div class="alert alert-danger">',
								'<strong>Username or password cannot be empty</strong>',
							'</div>';
			} else {
			  try {

			    $connection = new PDO($dsn, $username, $password, $options);
			    $new_user = array(
			      "name" => $_POST['name'],
			      "username"  => $_POST['username'],
			      "email"     => $_POST['email'],
			      "password"  => hash('sha256', escape($_POST["password"])),
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
					echo '<div class="alert alert-success">',
									'<strong>'.$_POST['username']."</strong> successfully added",
								'</div>';
			  } catch(PDOException $error) {
					echo '<div class="alert alert-danger">',
									'<strong>Something went wrong!</strong> Try a different user name.',
								'</div>';
			  }
			}
		} ?>
	</div>

	</form>
	<div class="form-input">
		<a href="index.php" type="button" class="btn btn-success">Back to home</a>
	</div>
</div>
<?php include "templates/footer.php"; ?>
