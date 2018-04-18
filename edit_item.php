<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$user_id = $_SESSION['user_id'];
$item_id = $_GET['id'];
$item = find_item((int)$item_id);
if (isset($_POST['submit'])) {
	// Process the form
	$title = trim($_POST['title']);
	$description = trim($_POST['description']);
	$link = trim($_POST['link']);
	$price = trim($_POST['price']);
	$weight = trim($_POST['weight']);
	$type = trim($_POST['type']);
	$type_id = get_item_type($type);
	
	$item_id = $_GET['id'];
	
	$update = "UPDATE items SET ";
	$update .= "title = '{$title}', ";
	$update .= "description = '{$description}', ";
	$update .= "link = '{$link}', ";
	$update .= "price = {$price}, ";
	$update .= "type_id = {$type_id}, ";
	$update .= "weight = {$weight}";
	$update .= " WHERE id = {$item_id};";
	
	$result = $conn->query($update);
    if ($result) {
      $_SESSION["message"] = "Item edit sucessfully.";
	  redirect_to("edit_item.php?id=".$item_id);
    } else {
	  echo "Error: " . $update . "<br>" . $conn->error;
      $_SESSION["message"] = "Editing item failed.";
	}	
}
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php echo message();?>

				<form class="form" action="edit_item.php/?id=<?php echo $item['id']; ?>" method="post">

					<div class="form-group">
						<label>Title</label>
						<input required type="text" name="title" value="<?php echo $item['title'];  ?>">
					</div>

					<div class="form-group">
						<label>Description</label>
						<input required type="text" name="description" value="<?php echo $item['description'];  ?>">
					</div>
					
					<div class="form-group">
						<label>Price ($)</label>
						<input required type="float" name="price" value="<?php echo $item['price'] ?>">
					</div>
					
					<div class="form-group">
						<label>Weight</label>
						<input required type="number" name="weight" value="<?php echo $item['weight']; ?>">
					</div>
					<div class="form-group">
						<label>Link</label>
						<input required type="text" name="link" value="<?php echo $item['link']; ?>">
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

					<input class="btn btn-success" value="Edit Item" type="submit" name="submit">

				</form>

			</div>
		</div>
	</div>
<?php require_once("./includes/db_close_connection.php"); ?>