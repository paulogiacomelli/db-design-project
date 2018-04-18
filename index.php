<?php define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'); ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>

<?php include("includes/layouts/header.php"); ?>
<div class="container">
<h2>Click to login into the app</h2>
<a class="btn btn-success" href="login.php" >Login</a>
</div>
<?php require_once("includes/db_close_connection.php");  ?>
<?php include("includes/layouts/footer.php"); ?>