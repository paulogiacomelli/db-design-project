<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>
<?php
confirm_logged_in($_SESSION['user_id']);
$users = view_users();
?>
<?php include("includes/layouts/header.php"); ?>
	<div class="container">
		<div class="row">
				<div class="col-sm-12">
				<h2>All Users</h2>
                <table class="table table-hover">
					<tr>
						<td>Name</td>
						<td>Email</td>
						<td>Password</td>
						<td>Role</td>
					</tr>
					<?php while($user = $users->fetch_assoc()) { ?>
					
					<tr>
						<td>
							<?php echo htmlentities($user["name"]); ?>
						</td>
						<td>
							<?php echo htmlentities($user["email"]); ?>
						</td>
						<td>
							<?php echo htmlentities($user["password"]); ?>
						</td>
						<td>
							<?php echo get_role($user["role_id"]); ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				
			</div>
	</div>
	
<?php require_once("includes/db_close_connection.php");  ?>
<?php include("includes/layouts/footer.php"); ?>