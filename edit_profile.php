<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$user_id = $_SESSION['user_id'];
$personal_info = get_personal_info($user_id);
if (isset($_POST['submit'])) {
	// Process the form
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$height = $_POST['height'];
	$weight = $_POST['weight'];
	$fitness_level = $_POST['fitness_level'];
		
	$dob = date('Y-m-d', strtotime($dob));
	
	$level_id = get_fit_level($fitness_level);

	$insert  = "INSERT INTO personal_info (";
    $insert .= "user_id, fit_level_id, date_of_birth, gender, height, weight";
    $insert .= ") VALUES (";
    $insert .= "  {$user_id}, {$level_id}, '{$dob}', '{$gender}', {$height}, {$weight} ";
    $insert .= ")";
	//echo $sql;
	
	
	$update = "UPDATE personal_info SET ";
	$update .= "user_id = {$user_id}, ";
	$update .= "fit_level_id = {$level_id}, ";
	$update .= "date_of_birth = '{$dob}', ";
	$update .= "gender = '{$gender}', ";
	$update .= "height = {$height}, ";
	$update .= "weight = {$weight}";
	$update .= " WHERE user_id = {$user_id};";
	
	if($personal_info) {
		$result = $conn->query($update);
		
	} else {
		$result = $conn->query($insert);
	}

    if ($result) {
      // Success
      $_SESSION["message"] = "Edit profile sucessfully.";
	  redirect_to("edit_profile.php");
    } else {
	  echo "Error: " . $insert . "<br>" . $conn->error;
      $_SESSION["message"] = "Profile edit failed.";
    }
}
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 mx-auto">
			<?php echo message();?>
				<form class="form" action="edit_profile.php" method="post">

					<div class="form-group">
						<label>Date Of Birth</label>
						<input class="form-control" required type="text" name="dob" value="<?php echo date('m/d/Y', strtotime($personal_info['date_of_birth']));  ?>">
					</div>

					<div class="form-group">
						<label>Gender</label>
						<select class="form-control" name="gender">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					
					<div class="form-group">
						<label>Height (in)</label>
						<input class="form-control" placeholder="70" required type="number" name="height" value="<?php echo $personal_info['height'];?>">
					</div>
					
					<div class="form-group">
						<label>Weight (lbs)</label>
						<input class="form-control" placeholder="190" required type="number" name="weight" value="<?php echo $personal_info['weight']; ?>">
					</div>
					
					<div class="form-group">
						<label>Fitness Level</label>
						<select class="form-control" name="fitness_level">
							<option value="Beginner">Beginner</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Expert">Expert</option>
						</select>
					</div>

					<input class="btn btn-success" value="Edit Profile" type="submit" name="submit">

				</form>

			</div>
		</div>
<?php require_once("./includes/db_close_connection.php"); ?>