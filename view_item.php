<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
confirm_logged_in($_SESSION['user_id']);
$id = $_GET['id'];
$item = find_item($id);

?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
				<div class="col-sm-12">
				<h2>User Inventory Item</h2>
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
							<a href="<?php echo URL ?>edit_item.php/?id=<?php echo $item['id']?>">Edit</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php require_once("includes/db_close_connection.php");  ?>
	<?php include("includes/layouts/footer.php"); ?>