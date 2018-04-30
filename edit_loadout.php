<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$user_id = $_SESSION['user_id'];
$loadout_id = $_GET['id'];
$loadout = find_loadout((int)$loadout_id);
if (isset($_POST['submit'])) {
	// Process the form
	$description = trim($_POST['description']);
	$notes = trim($_POST['notes']);
	$weather = trim($_POST['weather']);
	
	$loadout_id = $_GET['id'];
	
	$update = "UPDATE loadouts SET ";
	$update .= "description = '{$description}', ";
	$update .= "notes = '{$notes}', ";
	$update .= "weather = '{$weather}' ";
	$update .= " WHERE id = {$loadout_id};";
	
	$result = $conn->query($update);
    if ($result) {
      $_SESSION["message"] = "Loadout edited sucessfully.";
	  redirect_to("edit_loadout.php?id={$loadout['id']}");
    } else {
	  echo "Error: " . $update . "<br>" . $conn->error;
      $_SESSION["message"] = "Editing loadout failed.";
	}	
}
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 mx-auto">
			<?php echo message();?>
				<form class="form" action="edit_loadout.php/?id=<?php echo $loadout['id']; ?>" method="post">

					<div class="form-group">
						<label>Description</label>
						<input class="form-control" required type="text" name="description" value="<?php echo $loadout['description'];  ?>">
					</div>
					
					<div class="form-group">
						<label>Notes</label>
						<input class="form-control" required type="text" name="notes" value="<?php echo $loadout['notes'] ?>">
					</div>
					
					<div class="form-group">
						<label>Weather</label>
						<select class="form-control" name="weather">
							<option value="Spring">Spring</option>
							<option value="Summer">Summer</option>
							<option value="Winter">Winter</option>
							<option value="Fall">Fall</option>
						</select>
					</div>

					<input class="btn btn-success" value="Edit Loadout" type="submit" name="submit">
					<a class="btn btn-warning" href="<?php echo URL ?>view_loadout.php/?id=<?php echo $loadout['id']?>">Back to Loadout</a>

				</form>


			</div>
		</div>
<?php require_once("./includes/db_close_connection.php"); ?>