<?php
if (isset($_POST['submit'])) {
	try {
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);
        	// fetch data code will go here
		$sql = "SELECT *
			FROM users
			WHERE location = :location";
		$location = $_POST['location'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>



<?php include "templates/header.php"; ?>

<?php
	if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email Address</th>
					<th>Location</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
<?php		foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["firstname"]); ?></td>
				<td><?php echo escape($row["lastname"]); ?></td>
				<td><?php echo escape($row["email"]); ?></td>
				<td><?php echo escape($row["location"]); ?></td>
				<td><?php echo escape($row["date"]); ?> </td>
			</tr>
		<?php } ?>
			</tbody>
		</table>
	<?php } else 	{ ?>
			<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
<?php	}
}?>

<body>
	<div class="container main-body">
		<div class="jumbotron text-center" style="background-color: #337ab7 !important; color: #f7f7f7">
			<h2> Find all Users at your Location </h2>
		</div>

		<form method="post">
			<div class="form-input">
				<label for="location">Location</label>
				<input type="text" id="location" name="location" class="form-control">
			</div>
			<div class="form-input">
				<input type="submit" name="submit" value="View Results" class="btn btn-success">
			</div>
		</form>
		<div class="form-input">
			<a href="index.php" type="button" class="btn btn-success">Back to home</a>
		</div>
</div>

<?php include "templates/footer.php"; ?>
