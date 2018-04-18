<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$user_id = $_SESSION['user_id'];
$description = "";
$notes = "";
$weather = "";
if (isset($_POST['submit'])) {
	// Process the form
	$description = trim($_POST['description']);
	$notes = trim($_POST['notes']);
	$weather = trim($_POST['weather']);
			
	$insert  = "INSERT INTO loadouts (";
    $insert .= "description, notes, weather";
    $insert .= ") VALUES (";
    $insert .= "  '{$description}', '{$notes}', '{$weather}' ";
    $insert .= ")";
	
	$result = $conn->query($insert);
    if ($result) {
      // Success
	  $last_id = $conn->insert_id;
	  add_loadout($user_id, $last_id);
	  date_loadout($last_id);
		
      $_SESSION["message"] = "Item added sucessfully.";
	  redirect_to("user.php");
    } else {
	  echo "Error: " . $insert . "<br>" . $conn->error;
      $_SESSION["message"] = "Adding item failed.";
    }

}
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<a class="btn btn-warning" href="user.php">Home</a>
			</div>
			<div class="col-sm-6">
				<form class="form" action="add_loadout.php" method="post">

					<div class="form-group">
						<label>Description</label>
						<input required type="text" name="description" value="<?php echo $description;  ?>">
					</div>
					
						<div class="form-group">
						<label>Notes</label>
						<input required type="text" name="notes" value="<?php echo $notes ?>">
					</div>
					
					<div class="form-group">
						<label>Weather</label>
						<select name="weather">
							<option value="Spring">Spring</option>
							<option value="Summer">Summer</option>
							<option value="Winter">Winter</option>
							<option value="Fall">Fall</option>
						</select>
					</div>
					<input class="btn btn-success" value="Add Loadout" type="submit" name="submit">

				</form>

			</div>
		</div>
<?php require_once("./includes/db_close_connection.php"); ?>