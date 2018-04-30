<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$email = "";

if (isset($_POST['submit'])) {
  // Process the form

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $found_user = login($email, $password);
	
	
    if ($found_user) {
      // Success
      $_SESSION["user_id"] = $found_user["id"];
      $_SESSION["email"] = $found_user["email"];

      redirect_to("user.php");
    } else {
      // Failure
      $_SESSION["errors"] = "Username and Password not found.";
    }
} 
?>
<?php include("includes/layouts/header.php"); ?>
  <div class="container">
  <div class="row">
  <div class="col-sm-4 mx-auto">
  <?php echo errors() ?>
  <h2>Login</h2>

<form class="form" action="login.php" method="post">

<p>Username: 
<input required class="form-control" type="email" name="email" placeholder="paulo@email.com" value="<?php echo htmlentities($email); ?>"></p> 

<p>Password: 
<input required class="form-control" type="password" placeholder="1234" name="password" value=""></p>

<input class="btn btn-success" value="Submit" type="submit" name="submit">

</form>
  </div>
  </div>
  </div>
     

<?php require_once("includes/db_close_connection.php");  ?>
<?php include("includes/layouts/footer.php"); ?>
