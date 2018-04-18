<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
	$item_id = $_POST['item'];
	$loadout_id = $_POST['loadout'];
	
	$item = find_item($item_id);
	$loadout = find_loadout($loadout_id);
		
	$sql = "INSERT INTO loadout_items (";
	$sql .= " loadout_id, item_id";
	$sql .= ") VALUES (";
	$sql .= " {$loadout['id']}, {$item['id']}";
	$sql .= ")";
	
	$result = $conn->query($sql);
	
	if ($result) {
		$_SESSION["message"] = "Item added to loadout.";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		$_SESSION["message"] = "Problem adding to loadout.";
	}
} 

$item_set = get_items();
$loadout_set = get_loadouts();

?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php echo message();?>
			<p>Add: Item to Equip Item to Loadout 0. <br>Others are equipped and I am not checking for duplicates.</p>
				<form class="form" action="equip_inventory.php" method="post">

					<div class="form-group">
						<label for="item">Select Item:</label>
						<select class="form-control" name="item">
							<?php while($item = $item_set->fetch_assoc()) { ?>
								<option value="<?php echo $item["id"]; ?>"><?php echo htmlentities($item["title"]); ?></option>
							<?php } ?>
				  		</select>
					</div>

					<div class="form-group">
						<label for="item">Select Loadout:</label>
						<select class="form-control" name="loadout">
							<?php while($loadout = $loadout_set->fetch_assoc()) { ?>
								<option value="<?php echo $loadout["id"]; ?>"><?php echo htmlentities($loadout["description"]); ?></option>
							<?php } ?>
				  		</select>
					</div>

					<input class="btn btn-success" value="Equip Item" type="submit" name="submit">

				</form>

			</div>
		</div>



		<?php require_once("./includes/db_close_connection.php"); ?>