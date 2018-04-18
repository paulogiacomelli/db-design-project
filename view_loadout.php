<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
confirm_logged_in($_SESSION['user_id']);
$id = $_GET['id'];

$loadout = find_loadout($id);
$date_loadout = get_loadout_date($loadout['id']);
$date = date('m/d/Y', strtotime($date_loadout['created_at']));

$items = get_loadout_items($id);

?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
				<div class="col-sm-12">
				<h2>User Loadouts</h2>
				<table class="table table-hover table-default">
					<tr>
						<td>ID</td>
						<td>Title</td>
						<td>Notes</td>
						<td>Weather</td>
						<td>Created At</td>
						<td>Action</td>
					</tr>
					<tr>
					<td>
							<?php echo htmlentities($loadout["id"]); ?>
						</td>
						<td>
							<?php echo htmlentities($loadout["description"]); ?>
						</td>
						<td>
							<?php echo htmlentities($loadout["notes"]); ?>
						</td>
						<td>
							<?php echo htmlentities($loadout["weather"]); ?>
						</td>
						<td>
							<?php echo $date; ?>
						</td>
						<td>
							<a href="<?php echo URL ?>edit_loadout.php/?id=<?php echo $loadout['id']?>">Edit</a>

						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
		<div class="col-sm-12">
			<h2>Items of Loadout</h2>
			<table class="table table-hover table-default">
					<tr>
						<td>ID</td>
						<td>Type</td>
						<td>Title</td>
						<td>Description</td>
						<td>Price</td>
						<td>Weight</td>
						<td>Link</td>
						<td>Action</td>
					</tr>
					<?php while($item = $items->fetch_assoc()) { ?>
					<tr>
						<td>
							<?php echo htmlentities($item["id"]); ?>
						</td>
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
							<?php echo htmlentities($item["link"]); ?>
						</td>
						<td>
							<a href="<?php echo URL ?>view_item.php/?id=<?php echo $item['id']?>">View</a>
						</td>
					</tr>
					<?php } ?>			
				</table>				
		</div>
		</div>
	</div>
	<?php require_once("includes/db_close_connection.php");  ?>
	<?php include("includes/layouts/footer.php"); ?>