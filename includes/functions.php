<?php 
require_once('vendor/fzaninotto/faker/src/autoload.php');
define('URL', 'http://students.cs.umt.edu/~pg216938/db-design-project/');

// General Functions
function redirect_to($new_location) {
	header("Location: " . URL.$new_location);
	exit;
}

function confirm_query($result_set) {
	if(!$result_set) {
    	die("Database query failed.");
	}
}

function has_presence($value) {
	return isset($value) && $value !== "";
}

function create_tables() {
	global $conn;
	$sql = "
	CREATE TABLE roles
	(
	  id INT NOT NULL AUTO_INCREMENT,
	  role VARCHAR(20) NOT NULL,
	  PRIMARY KEY (id)
	);

	CREATE TABLE fitness_level
	(
	  id INT NOT NULL AUTO_INCREMENT,
	  level VARCHAR(20) NOT NULL,
	  PRIMARY KEY (id)
	);

	CREATE TABLE types
	(
	  id INT NOT NULL AUTO_INCREMENT,
	  type VARCHAR(20) NOT NULL,
	  PRIMARY KEY (id)
	);

	CREATE TABLE users (
		id INT NOT NULL AUTO_INCREMENT,
		role_id INT,
		name varchar(50) NOT NULL,
		email varchar(50) NOT NULL,
		password varchar(30) NOT NULL,
		PRIMARY KEY (id),
		FOREIGN KEY (role_id) REFERENCES roles(id),
		UNIQUE (email)
	);

	CREATE TABLE personal_info (
		id INT NOT NULL AUTO_INCREMENT,
		user_id INT,
		fit_level_id INT,
		date_of_birth DATE,
		gender varchar(20),
		height INT,
		weight INT,
		PRIMARY KEY (id),
		FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
		FOREIGN KEY (fit_level_id) REFERENCES fitness_level(id)
	);

	CREATE TABLE loadouts (
		id INT NOT NULL AUTO_INCREMENT,
		description varchar(255) NOT NULL,
		notes varchar(255),
		weather varchar(30),
		PRIMARY KEY (id)
	);

	CREATE TABLE items (
		id INT NOT NULL AUTO_INCREMENT,
		type_id INT NOT NULL,
		title varchar(30) NOT NULL,
		description varchar(255) NOT NULL,
		link varchar(255),
		price DECIMAL(10,2),
		weight INT,
		PRIMARY KEY (id),
		FOREIGN KEY (type_id) REFERENCES types(id)
	);

	CREATE TABLE locations (
		id INT NOT NULL AUTO_INCREMENT,
		loadout_id INT NOT NULL,
		name varchar(40) NOT NULL,
		area varchar(40) NOT NULL,
		intensity varchar(20),
		distance DECIMAL(5,2),
		PRIMARY KEY (id),
		FOREIGN KEY (loadout_id) REFERENCES loadouts(id) ON DELETE CASCADE 
	);

	CREATE TABLE dated_loadouts (
		loadout_id INT NOT NULL,
		created_at DATE NOT NULL,
		PRIMARY KEY (loadout_id),
		FOREIGN KEY (loadout_id) REFERENCES loadouts(id) ON DELETE CASCADE
	);

	CREATE TABLE user_loadouts (
		user_id INT NOT NULL,
		loadout_id INT NOT NULL,
		PRIMARY KEY (user_id, loadout_id),
		FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
		FOREIGN KEY (loadout_id) REFERENCES loadouts(id) ON DELETE CASCADE
	);

	CREATE TABLE user_inventory (
		user_id INT NOT NULL,
		item_id INT NOT NULL,
		PRIMARY KEY (user_id, item_id),
		FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
		FOREIGN KEY (item_id) REFERENCES items(id)
	);

	CREATE TABLE loadout_items (
		loadout_id INT NOT NULL,
		item_id INT NOT NULL,
		PRIMARY KEY (loadout_id, item_id),
		FOREIGN KEY (loadout_id) REFERENCES loadouts(id) ON DELETE CASCADE,
		FOREIGN KEY (item_id) REFERENCES items(id)
	);
	";

	if($sql) {
		echo "DB tables created";
		return $conn->multi_query($sql);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		return null;
	}
}

function drop_db() {
	global $conn;
	
	$drop = "DROP DATABASE pg216938";

	if($drop) {
		echo "DB dropped";
		return $conn->query($drop);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		return null;
	}
}

function create_db() {
	$db = new mysqli("localhost", "pg216938", "ier0phie6phahT8ahpai");

	$create = "CREATE DATABASE pg216938";

	if($create) {
		echo "<br>DB created";
		return $db->query($create);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		return null;
	}
	
	}

function seed_tables() {
	global $conn;
	$created_at = date("Y-m-d");
	$users = "";
	$sql = "";
	
	$sql .= "INSERT INTO roles (role) VALUE ('user'), ('admin'); ";
	$sql .= "INSERT INTO types (type) VALUE ('Head'), ('Torso'), ('Legs'), ('Feet'), ('Backpack'); ";
	$sql .= "INSERT INTO fitness_level (level) VALUE ('Beginner'), ('Intermediate'), ('Expert'); ";
	
	$faker = Faker\Factory::create();
	$sql .= "INSERT INTO items (type_id, title, description, link, price, weight) VALUE ";
	for($i = 0; $i <= 15; $i++) {
		
		$sql .= '('.$faker->numberBetween($min = 1, $max = 4).', ';
		$sql .= '"Item '.$i.'", ';
		$sql .= '"'.$faker->catchPhrase.'", ';
		$sql .= '"'.$faker->url.'", ';
		$sql .= $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 30).', ';
		$sql .= $faker->randomNumber($nbDigits = 2).'), ';
	}
		$sql .= "(1, 'Head Item', 'Item for the head', 'amazon.com', 5.50, 5), (2, 'Item to Equip (TEST)', 'Item for the Lolo Peak Loadout', 'amazon.com', 15.50, 10); ";
	
	$sql .= "INSERT INTO loadouts (description, notes, weather) VALUE ";
	for($i = 0; $i <= 8; $i++) {
		$sql .= '("Loadout '.$i.'", ';
		$sql .= '"'.$faker->catchPhrase.'", ';
		$sql .= '"'.$faker->randomElement(["Winter","Summer","Fall","Spring"]).'"), ';
	}
		$sql .= "('Loadout for Lolo Peak (TEST)', 'Cool Loadout', 'Winter'); ";
	
	$sql .= "INSERT INTO users (role_id, name, email, password) VALUE ";
	for($i = 0; $i < 10; $i++) {
		$sql .= '(1, ';
		$sql .= '"'.$faker->name.'", ';
		$sql .= '"'.$faker->email.'", ';
		$sql .= '"1234"), ';
	}
	$sql .= "(1, 'Paulo Giacomelli', 'paulo@email.com', '1234'); ";
	$sql .= "INSERT INTO dated_loadouts (loadout_id, created_at) VALUE (1, '{$created_at}'), (2, '{$created_at}'), (3, '{$created_at}'), ";
	$sql .= "(4, '{$created_at}'), (5, '{$created_at}'), (6, '{$created_at}'), (7, '{$created_at}'), (8, '{$created_at}'), (9, '{$created_at}'), (10, '{$created_at}'); ";
	$sql .= "INSERT INTO loadout_items (loadout_id, item_id) VALUE (10, 1), (10, 2), (10, 3), (10, 4), (10, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10); ";	
	$sql .= "INSERT INTO user_inventory (user_id, item_id) VALUE (11, 1), (11, 2), (11, 3), (11, 4), (11, 5), (11, 6), (11, 7), (11, 8), (11, 9), (11, 10), (11,18); ";	
	$sql .= "INSERT INTO user_loadouts (user_id, loadout_id) VALUE (11, 10), (11, 1); ";	
	// $sql .= "INSERT INTO locations (loadout_id, name, area, intensity, distance) VALUE (10, 'Lolo Peak', 'Lolo', 'Very Intense', 5); ";
	$sql .= "INSERT INTO locations (loadout_id, name, area, distance, intensity) VALUE ";
	for($i = 1; $i <= 8; $i++) {
		$sql .= '('.$i.', ';
		$sql .= '"Location '.$i.'", ';
		$sql .= '"'.$faker->city.'", ';
		$sql .= $faker->randomNumber($nbDigits = 2).', ';
		$sql .= '"'.$faker->randomElement(["Hard","Medium","Easy"]).'"), ';
	}
		$sql .= "(10, 'Lolo Peak', 'Lolo', 5, 'Very Intense'); ";

	if($sql) {
		echo "DB tables seeded";
		return $conn->multi_query($sql);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		return null;
	}
	
}

function get_data($table) {
	global $conn;

	$sql = "SELECT * FROM {$table}";
	$data = $conn->query($sql);

	if ($data) {
		return $data;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

}

// 1. View all users - view_users.php
function view_users() {
	global $conn;
	
	$sql = "SELECT * FROM users";
	$users =  $conn->query($sql);
	
	return $users;
}

// 2. Equip an inventory item  - equip_inventory.php
// 3. View All Loadouts - view_loadouts.php
// 4. View Item - view_item.php
// 5. View Specific Loadout - view_loadout.php
// 6. Edit Loadout = edit_loadout.php
// 7. Edit Item - edit_item.php
// 8. View inventory - view_inventory.php
function get_items() {
	global $conn;
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM user_inventory, items WHERE user_id = {$user_id} and id = item_id;";
	$items = $conn->query($sql);
	if ($items) {
		return $items;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function get_items_not_in_loadout($id) {
	global $conn;

	$sql = "SELECT * FROM items WHERE id NOT IN (SELECT id FROM loadout_items, items WHERE loadout_id = {$id} and item_id = items.id);";
	$items = $conn->query($sql);
	if ($items) {
		return $items;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function get_loadout_items($id) {
	global $conn;

	$sql = "SELECT * FROM loadout_items, items where loadout_id = {$id} and item_id = items.id;";
	$items = $conn->query($sql);
	if ($items) {
		return $items;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function find_item($id) {
	global $conn;
	
	$sql = "SELECT * FROM items where id = ".$id.";";
	$item_set = $conn->query($sql);
	if($item = $item_set->fetch_assoc()) {
    	return $item;
    } 
}

function find_loadout($id) {
	global $conn;
	
	$sql = "SELECT * FROM loadouts where id = ".$id.";";
	$loadout_set = $conn->query($sql);
	if($loadout = $loadout_set->fetch_assoc()) {
    	return $loadout;
    } 
}

function get_loadouts() {
	global $conn;
	
	// get user id
	$id = $_SESSION['user_id'];

    $sql  = "SELECT * ";
    $sql .= "FROM loadouts, user_loadouts ";
    $sql .= "WHERE user_id = {$id} and loadout_id = id ";
    $loadout_set = $conn->query($sql);
	if ($loadout_set) {
		return $loadout_set;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function add_loadout($user_id, $loadout_id) {
	global $conn;
	$sql = "INSERT INTO user_loadouts (user_id, loadout_id) VALUE ({$user_id}, {$loadout_id});";
	
	if ($conn->query($sql)) {
		return true;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
		
}

// 9. Date the loadouts when created - create_loadout.php
function date_loadout($loadout_id) {
	global $conn;
	$created_at = date("Y-m-d");
	$sql = "INSERT INTO dated_loadouts (loadout_id, created_at) VALUES ({$loadout_id}, '{$created_at}');";
	if ($conn->query($sql)) {
		return true;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// 10. Get the date the loadout was created - view_loadout.php
function get_loadout_date($loadout_id) {
	global $conn;
	$sql = "SELECT * FROM dated_loadouts where loadout_id = {$loadout_id} LIMIT 1";
	$date_set = $conn->query($sql);
    if($date = $date_set->fetch_assoc()) {
    	return $date;
    } else {
    	return false;
	}
}

// 11. Add item to inventory - add_item.php
function get_item_type($type) {
	global $conn;
	$sql = "SELECT * FROM types WHERE type = '{$type}'";
	$types_set = $conn->query($sql);
	if($type = $types_set->fetch_assoc()) {
    	return $type['id'];
    } else {
    	return null;
	}
}

function get_type($id) {
	global $conn;
	$sql = "SELECT * FROM types where id = {$id} LIMIT 1;";
	$type_set = $conn->query($sql);
	if($type = $type_set->fetch_assoc()) {
    	return $type['type'];
    } else {
    	return null;
	}
}

function add_inventory($user_id, $item_id) {
	global $conn;
	$sql = "INSERT INTO user_inventory (user_id, item_id) VALUE ({$user_id}, {$item_id});";
		
	if ($conn->query($sql)) {
		return true;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
		
}

// 12. Log in user
function login($email, $password) {
	$user = find_user($email);
	
	if ($user) {
		if(check_password($password, $user['password'])) {
			return $user;
			
		} else {
			// pass do not match
			return false;
		}
		
	} else {
		// user not found
		return false;
	}
}

function find_user($email) {
	global $conn;
	
    $sql  = "SELECT * ";
    $sql .= "FROM users ";
    $sql .= "WHERE email = '{$email}' ";
    $sql .= "LIMIT 1";
    $user_set = $conn->query($sql);
    if($user = $user_set->fetch_assoc()) {
    	return $user;
    } 
    else {
    	return null;
	}
}

function check_password($password, $db_pass) {
	return $password === $db_pass;
}

function logged_in() {
	return isset($_SESSION['user_id']);
}

function confirm_logged_in() {
	if (!logged_in()) {
  		redirect_to("login.php");
	}
}

// 13. Add personal info
function get_fit_level($level) {
	global $conn;
	$sql = "SELECT * FROM fitness_level WHERE level = '{$level}'";
	$level_set = $conn->query($sql);
	if($level = $level_set->fetch_assoc()) {
    	return $level['id'];
    } 
    else {
    	return null;
	}
}

function get_personal_info($id) {
	global $conn;
	
    $sql  = "SELECT * ";
    $sql .= "FROM users, personal_info ";
    $sql .= "WHERE users.id = {$id} AND personal_info.user_id = {$id} ";
    $sql .= "LIMIT 1";
    $user_set = $conn->query($sql);
    if($user = $user_set->fetch_assoc()) {
    	return $user;
    } 
    else {
    	return false;
	}
}

?>