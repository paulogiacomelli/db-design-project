<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
confirm_logged_in($_SESSION['user_id']);
$loadouts = get_loadouts();

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
			<h2>User Loadouts</h2>
			<table class="table table-hover table-default">
					<tr>
						<td>ID</td>
						<td>Description</td>
						<td>Notes</td>
						<td>Weather</td>
						<td>Created At</td>
						<td>Action</td>
					</tr>
					<?php while($loadout = $loadouts->fetch_assoc()) { ?>
					<tr>
						<td>
							<?php echo htmlentities($loadout["id"]); ?>
						</td>
						<td>
						<?php 
						    echo htmlentities($loadout['description']);
							?>
		
						</td>
						<td>
							<?php echo htmlentities($loadout["notes"]); ?>
						</td>
						<td>
							<?php echo htmlentities($loadout["weather"]); ?>
						</td>
						<td>
							<?php 
							$date_loadout = get_loadout_date($loadout['id']);
$date = date('m/d/Y', strtotime($date_loadout['created_at']));
							echo $date;
							?>
						</td>
						<td>
							<a href="<?php URL ?>view_loadout.php/?id=<?php echo $loadout['id']?>">View</a>	
						</td>
					</tr>
					<?php } ?>			

				</table>
			</div>
		</div>
	<?php require_once("includes/db_close_connection.php");  ?>
</body>
</html>