<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$email = "";

if (isset($_POST['submit'])) {
  // Process the form
  
  // Validations
  
  //if (empty($errors)) {
    // Attempt Login

    $email = $_POST["email"];
    $password = $_POST["password"];

    $found_user = login($email, $password);
	
	
    if ($found_user) {
      // Success
      $_SESSION["user_id"] = $found_user["id"];
      $_SESSION["email"] = $found_user["email"];

      redirect_to("user.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username and Password not found.";
    }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
<?php include("includes/layouts/header.php"); ?>
<!-- Main Section -->
<div class="col-sm-9">
<div class="container">                

      <br>

      <h2>Login</h2>

      <form class="form" action="login.php" method="post">

      <p>Username: 
      <input class="" type="text" name="email" placeholder="paulo@email.com" value="<?php echo htmlentities($email); ?>"></p> 

      <p>Password: 
      <input type="password" placeholder="1234" name="password" value=""></p>

      <input class="btn btn-success" value="Submit" type="submit" name="submit">

      </form>
 </div>

</div>
<?php require_once("includes/db_close_connection.php");  ?>
<?php include("includes/layouts/footer.php"); ?>
