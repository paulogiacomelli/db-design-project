<!DOCTYPE html>
<html lang="en">
<head>
  <title>Outdoor Gear Checklist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>
.jumbotron {
    margin: 0px;
    padding: 150px;
}
.container {
    padding: 50px;
}
h1 a {
  text-decoration: none;
  color: white;
}
h1 a:hover {
  text-decoration: underline;
  color: white;
}
.navbar-brand:hover{
  text-decoration: underline;
}
.nav-link {
  color: white !important;
}
</style>
</head> 

<body>
<div class="jumbotron" style="background-image: url('<?php echo URL ?>/includes/bg2.jpg');">
	<h1 class="text-center"><a class="link" href="<?php echo URL ?>user.php">OGC App</h1></a>
</div>
<?php if (logged_in()) { ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <!-- Links -->
  <a class="navbar-brand" href="edit_profile.php">Edit: <?php echo $_SESSION['email']?></a>
  <ul class="navbar-nav ml-auto">
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Admin Functions
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="user.php?drop_db">DROP DB</a>
        <a class="dropdown-item" href="user.php?create_db">Create DB</a>
        <a class="dropdown-item" href="user.php?create_tables">Create DB Tables</a>
        <a class="dropdown-item" href="uuser.php?seed_tables">Seed DB Tables</a>
				<a class="dropdown-item" href="view_users.php">View Users</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        User Functions
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo URL ?>loadouts.php">View Loadouts</a>
        <a class="dropdown-item" href="<?php echo URL ?>view_inventory.php">View Inventory</a>
        <a class="dropdown-item" href="<?php echo URL ?>add_item.php">Add Item</a>
        <a class="dropdown-item" href="<?php echo URL ?>add_loadout.php">Add Loadout</a>
        <a class="dropdown-item" href="<?php echo URL ?>loadouts.php">Equip Items (Choose Loadout)</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo URL ?>descriptions.php">Function Descriptions</a>
    </li>
  </ul>

</nav>
<?php } ?>
