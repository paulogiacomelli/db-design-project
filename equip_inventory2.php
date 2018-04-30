<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
$id = $_GET['id'];

if (isset($_POST['submit'])) {
  // Process the form
  $items = $_POST['items'];
  if(count($items) < 1) {
	  $_SESSION["errors"] = "Make sure you select an item to be added to the loadout. (You might get an error uptop)";
  } else {
	for($i = 0; $i < count($items); $i++) {
		$sql = "INSERT INTO loadout_items (";
		$sql .= " loadout_id, item_id";
		$sql .= ") VALUES (";
		$sql .= " {$id}, {$items[$i]}";
		$sql .= ");";
		//echo $sql;
		$result = $conn->multi_query($sql);
	}
	if ($result) {
		$_SESSION["message"] = "Items added to loadout.";
		//redirect_to('view_loadout.php?id='.$id);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		$_SESSION["errros"] = "Problem adding to loadout.";
	}
	} 

}

$item_set = get_items_not_in_loadout($id);
$loadout = find_loadout($id);


?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
                <?php echo message();?>
				<?php echo errors();?>
                <h2>Select Items For: <a href="<?php echo URL; ?>view_loadout.php/?id=<?php echo $loadout['id']; ?>"><?php echo $loadout['description'];?></a></h2>

				<form class="form" action="<?php echo URL; ?>equip_inventory2.php/?id=<?php echo $loadout['id']; ?>" method="post">
					<div class="form-group">
                        <table class="table table-hover table-default">
					<tr>
						<td>Type</td>
						<td>Title</td>
						<td>Description</td>
						<td>Price</td>
						<td>Weight</td>
						<td>Select</td>
					</tr>
                        <?php while($item = $item_set->fetch_assoc()) { ?>  
                  					<tr>
						<td>
						<?php 
						    echo get_type($item['type_id']);
							?>
		
						</td>
						<td>
							<?php echo htmlentities($item["title"]); ?>
						</td>
						<td>
							<?php echo htmlentities($item["description"]); ?>
						</td>
						<td>
							<?php echo "$".htmlentities($item["price"]); ?>
						</td>
						<td>
							<?php echo htmlentities($item["weight"]); ?>
						</td>
						<td>
                        <input name="items[]" type="checkbox" value="<?php echo $item["id"]; ?>">
						</td>
					</tr>
					<?php } ?>			

				</table>
					</div>
					<input class="btn btn-success" value="Equip Items" type="submit" name="submit">
				</form>

			</div>
		</div>
    </div>
<?php require_once("./includes/db_close_connection.php"); ?>