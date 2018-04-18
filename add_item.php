<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$user_id = $_SESSION['user_id'];
$title = "";
$description = "";
$link = "";
$price = "";
$weight = "";
if (isset($_POST['submit'])) {
	// Process the form
	$title = trim($_POST['title']);
	$description = trim($_POST['description']);
	$link = $_POST['link'];
	$price = $_POST['price'];
	$weight = $_POST['weight'];
	$type = $_POST['type'];

	$type_id = get_item_type($type);

	$insert  = "INSERT INTO items (";
    $insert .= "title, description, link, price, weight, type_id";
    $insert .= ") VALUES (";
    $insert .= "  '{$title}', '{$description}', '{$link}', {$price}, {$weight}, {$type_id} ";
    $insert .= ")";
	//echo $sql;
	
	$result = $conn->query($insert);
    if ($result) {
      // Success
	  $last_id = $conn->insert_id;
	  add_inventory($user_id, $last_id);
	
	  $_SESSION["message"] = "Item added sucessfully.";
	  redirect_to("add_item.php");
    } else {
	  echo "Error: " . $insert . "<br>" . $conn->error;
      $_SESSION["message"] = "Adding item failed.";
    }
}
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php echo message();?>

				<form class="form" action="add_item.php" method="post">

					<div class="form-group">
						<label>Title</label>
						<input required type="text" name="title" value="<?php echo $title;  ?>">
					</div>

					<div class="form-group">
						<label>Description</label>
						<input required type="text" name="description" value="<?php echo $description;  ?>">
					</div>
					
					<div class="form-group">
						<label>Price ($)</label>
						<input required type="number" name="price" value="<?php echo $price ?>">
					</div>
					
					<div class="form-group">
						<label>Weight</label>
						<input required type="number" name="weight" value="<?php echo $weight; ?>">
					</div>
					<div class="form-group">
						<label>Link</label>
						<input type="text" name="link" value="<?php echo $link; ?>">
					</div>
					
					<div class="form-group">
						<label>Item Type</label>
						<select name="type">
							<option value="Head">Head</option>
							<option value="Torso">Torso</option>
							<option value="Legs">Legs</option>
							<option value="Feet">Feet</option>
						</select>
					</div>

					<input class="btn btn-success" value="Add Item" type="submit" name="submit">

				</form>

			</div>
		</div>
<?php require_once("./includes/db_close_connection.php"); ?>