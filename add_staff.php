<?php include "templates/header.php"; ?>


<div class="container main-body">
	<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
		<h2> Add new staff to Library </h2>
	</div>
	<form method="post">
		<div class="form-input">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control">
		</div>
		<div class="form-input">
			<label for="password">Password</label>
			<input type="text" name="password" id="password" class="form-control">
		</div>
    <div class="form-input">
			<label for="branch_ID">Branch ID</label>
			<input type="text" name="branch_ID" id="branch_ID" class="form-control">
		</div>
		<div class="form-input">
			<input type="submit" name="submit" value="Submit" class="btn btn-success">
		</div>

  <?php if (isset($_POST['submit'])) {
  	require "common.php";
    require "config.php";
    $connection = mysqli_connect($host, $username, $password);
    $select_db = mysqli_select_db($connection, $dbname);

    $name = $_POST['name'];
    $password  = hash('sha256', escape($_POST["password"]));
    $branch = $_POST['branch_ID'];
    $sql = "INSERT INTO staff (name, password, branch_ID) values ('$name', '$password', '$branch');";
    $result = mysqli_query($connection, $sql);

    if ($result == true) {
      echo '<div class="alert alert-success col-md-10 col-md-offset-1">',
              '<strong>Successfully added.</strong>',
            '</div>';
    } else {
      echo '<div class="alert alert-danger col-md-10 col-md-offset-1">',
                '<strong>Try a different username!!</strong></a>',
              '</div>';
    }
  } ?>
  </form>

  <p></p>
	<div class="form-input">
		<a href="index.php" type="button" class="btn btn-success">Back to home</a>
	</div>
</div>
<?php include "templates/footer.php"; ?>
