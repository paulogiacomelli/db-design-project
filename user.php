<?php define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'); ?>
<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
// confirm_logged_in($_SESSION['user_id']);
if(isset($_GET['create_tables'])) {
	create_tables();
}
if(isset($_GET['seed_tables'])) {
	seed_tables();
}
if(isset($_GET['drop_db'])) {
	drop_db();

}
if(isset($_GET['create_db'])) {
	create_db();
}
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<h3>General Functions</h3>
			<p>Operate these in order given.</p>
				<a class="btn btn-danger" href="user.php?drop_db">1. Drop DB</a>
				<a class="btn btn-warning" href="user.php?create_db">2. Create DB</a>
				<a class="btn btn-success" href="user.php?create_tables">3. Create Tables DB</a>
				<a class="btn btn-info" href="user.php?seed_tables">4. Seed Tables DB</a>
			<hr>
			</div>
		</div>
		<div class="row">
		<div class="col-sm-12">
			<h3>User Functions</h3>
		</div>
			<div class="col-sm-6">
				<p><a class="btn btn-success" href="view_users.php">View Users</a>-  Show all the users in DB (Testing)</p>
				
				<p><a class="btn btn-success" href="loadouts.php">View Loadouts</a> - Show all the loadouts of the user in DB</p>
				
				<p><a class="btn btn-success" href="view_inventory.php">View Inventory</a> - Show all the items of the user in DB</p>
				
			</div>
			<div class="col-sm-6">
				<p><a class="btn btn-warning" href="add_item.php">Add Item</a> - Add an item to the user inventory</p>	
				
				<p>	<a class="btn btn-warning" href="equip_inventory.php">Equip Item</a> - Equip any user inventory item to a loadout</p>
					
				<p>	<a class="btn btn-warning" href="edit_profile.php">Edit Profile</a> - Edits the user profile</p>

			</div>
			<div class="col-sm-12">
			<h3>Other Functions</h3>
			<p><a class="btn btn-info" href="view_item.php/?id=1">View Item</a> - View Item Data</p>
			<p><a class="btn btn-info" href="view_loadout.php/?id=1">View Loadout/Items</a> - View Items in Loadout and Loadout Data </p>
			<p><a class="btn btn-info" href="add_loadout.php">Add Loadout</a> - Add a Loadout</p>	
			<p><a class="btn btn-info" href="edit_item.php/?id=1">Edit Item</a> - Edit Specific Item </p>
			<p><a class="btn btn-info" href="edit_loadout.php/?id=1">Edit Loadout</a> - Edit Specific Loadout </p>

			
		</div>
		</div>
	</div>
	<?php require_once("includes/db_close_connection.php");  ?>
	<?php include("includes/layouts/footer.php"); ?>