<div class="col-sm-12 text-center">
  <form method="post">
    <div class="form-input">
      <input type="submit" name="submit" value="Sign Out" class="btn btn-danger">
    </div>
  </form>
</div>
<?php
  if (isset($_POST['submit'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
  }
?>
