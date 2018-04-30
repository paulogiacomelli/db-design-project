<?php require_once("includes/sessions.php");  ?>
<?php require_once("includes/db_connection.php");  ?>
<?php require_once("includes/functions.php");  ?>

<?php include("includes/layouts/header.php"); ?>

<div class="container">
<div class="col-sm-12">
<h2>Function Description</h2>
<hr>
<p><strong>Function Number:</strong> 1</p>
<p><strong>Function Name:</strong>  View Users</p>
<p><strong>URL:</strong>  <a href="http://students.cs.umt.edu/~pg216938/db-design-project/view_users.php">
http://students.cs.umt.edu/~pg216938/db-design-project/view_users.php</a></p>
<p><strong>Function Type:</strong> Select Query</p>
<p><strong>Description:</strong>
This function allows the user/admin to quickly view all users and their roles.</p>
<p><strong>Primary Users:</strong>  Admin </p>
<p><strong>Tables affected: </strong> users, roles</p>
<p><strong>Sample Input:</strong> Button click from dropdown menu</p>
<p><strong>Sample Output:</strong>  List all users in a table with their information and roles</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because it allows the admin to quickly view and manage users current in the DB,
without having the knowledege of actually having to query the DB. I am also querying the roles table based on the foreign key
relationship in order to get the actual role, not just the id.</p>
<hr>

<p><strong>Function Number:</strong> 2</p>
<p><strong>Function Name:</strong>  View Loadouts</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/loadouts.php">
http://students.cs.umt.edu/~pg216938/db-design-project/loadouts.php</a></p>
<p><strong>Function Type:</strong> Select Query</p>
<p><strong>Description:</strong>
This function allows the user to view all loadouts that they currently have.</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, loadouts, dated_created, user_loadouts</p>
<p><strong>Sample Input:</strong> Button click from dropdown menu</p>
<p><strong>Sample Output:</strong>  List all loadouts in a table with their information</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because it allows the users to quickly view all loadouts that they
currently have. With that, each loadout has a view button and based on that ID they can manage/view the loadout information.</p>
<hr>

<p><strong>Function Number:</strong> 3</p>
<p><strong>Function Name:</strong>  View Inventory</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/view_inventory.php">
http://students.cs.umt.edu/~pg216938/db-design-project/view_inventory.php</a></p>
<p><strong>Function Type:</strong> Select Query</p>
<p><strong>Description:</strong>
This function allows the user to view all items in their inventory.</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, items, user_inventory, types</p>
<p><strong>Sample Input:</strong> Button click from dropdown menu</p>
<p><strong>Sample Output:</strong>  List all items in a table with their information</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because it allows the users to quickly view all the items they have in the inventory.
This will allow the user to quickly manage their items information. Also,
this function was particularly difficult to implement because it involved many tables. Even though it seems to be a simple query,
I had to go get informations from different tables by their relationships.</p>
<hr>

<p><strong>Function Number:</strong> 4</p>
<p><strong>Function Name:</strong>  Add Loadout</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/add_loadout.php">
http://students.cs.umt.edu/~pg216938/db-design-project/add_loadout.php</a></p>
<p><strong>Function Type:</strong> Insert Query</p>
<p><strong>Description:</strong>
This function allows the user to add a new loadout</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, loadouts, dated_loadout, user_loadouts</p>
<p><strong>Sample Input:</strong> Description: Loadout 1, Notes: Some Notes, Weather: Spring</p>
<p><strong>Sample Output:</strong> New loadout entry under view_loadouts.php</p>
<p><strong>Notes:</strong> 
This function was particularly difficult to implement because after having to insert into the DB
the loadout information, I had to generate the date the loadout was added to the DB, and add to a different
table that keeps track when a specific loadout was created. Also, This function includes error checking by
checking to make sure all input fields are filled and before entering the DB, those inputs have whitespaces trimmed.</p>
<hr>

<p><strong>Function Number:</strong> 5</p>
<p><strong>Function Name:</strong>  Add Item</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/add_item.php">
http://students.cs.umt.edu/~pg216938/db-design-project/add_item.php</a></p>
<p><strong>Function Type:</strong> Insert Query</p>
<p><strong>Description:</strong>
This function allows the user to add a new item to their inventory</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, items, user_inventory, type</p>
<p><strong>Sample Input:</strong> Title: Some title, Description: Some desc, Price: 15, Weight: 5, Link: amazon.com, Item Type: Head</p>
<p><strong>Sample Output:</strong> New item entry under view_inventory.php</p>
<p><strong>Notes:</strong> 
This function was particularly difficult to implement because before having to insert into the DB
the item information, I had to query the item type based on user input, then enter the item to the items table,
and after that I had to also figure out the user_id and the recent item_id and add those to user_inventory table.
Also, This function includes error checking by checking to make sure all input fields are filled and before entering the DB, those inputs have whitespaces trimmed.</p>
<hr>

<p><strong>Function Number:</strong> 6</p>
<p><strong>Function Name:</strong>  Equip Item</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/equip_inventory2.php?id=1">
http://students.cs.umt.edu/~pg216938/db-design-project/equip_inventory2?id=1.php</a><br>For testing purpose, link goes to loadout of id = 1, but all loadouts have the function.</p> 
<p><strong>Function Type:</strong> Insert Query</p>
<p><strong>Description:</strong>
This function allows the user to equip any number of items to a loadout.</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, items, loadout_items, user_loadouts, user_inventory, loadouts</p>
<p><strong>Sample Input:</strong>Select multiple checkboxes (items to equip) </p>
<p><strong>Sample Output:</strong> Your selected loadout now has all items you just added.</p>
<p><strong>Notes:</strong> 
This function was particularly difficult to implement because
there were so many tables involved in the process. When the user decides to equip an item, I go and take all items that
the user have in their inventory, and that are not already equipped in the loadout. So all items that you see can be equipped to the loadout.
After doing so, I insert into loadout_items the items/loadout. Also, I am checking for errors by not allowing the user to enter items that are already 
added to their loadout.
</p>
<hr>

<p><strong>Function Number:</strong> 7</p>
<p><strong>Function Name:</strong>  Edit Item</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/edit_item.php?id=1">
http://students.cs.umt.edu/~pg216938/db-design-project/edit_item?id=1.php</a><br>For testing purpose, link goes to item of id = 1, but all items have the function.</p> 
<p><strong>Function Type:</strong> Update Query</p>
<p><strong>Description:</strong>
This function allows the user to edit any item they have in their inventory.</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, items, user_inventory</p>
<p><strong>Sample Input:</strong> Title: Some title, Description: Some desc, Price: 15, Weight: 5, Link: amazon.com, Item Type: Head</p>
<p><strong>Sample Output:</strong> You can view your changes now in the item page.</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because 
it allows the user to edit any item information they would like. They can simply change their info, submit the form and a message shows up and everything went well.
Also, this function checks for errors by trimming any input in the backend and not allowing for blank inputs.
</p>
<hr>

<p><strong>Function Number:</strong> 8</p>
<p><strong>Function Name:</strong>  Edit Loadout</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/edit_loadout.php?id=1">
http://students.cs.umt.edu/~pg216938/db-design-project/edit_loadout?id=1.php</a><br>For testing purpose, link goes to loadout of id = 1, but all loadouts have the function.</p> 
<p><strong>Function Type:</strong> Update Query</p>
<p><strong>Description:</strong>
This function allows the user to edit any loadout they currently have.</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, loadouts, user_loadouts</p>
<p><strong>Sample Input:</strong> Description: Loadout 1, Notes: Some Notes, Weather: Spring</p>
<p><strong>Sample Output:</strong> You can view your changes now in the loadout page.</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because 
it allows the user to edit any loadout information they would like. From the user page, or loadouts page, the user
will only view their specific loadouts. From there they can click EDIT, which it will allow the users to update specific loadout info. They should
then see a message if everything went well.
Also, this function checks for errors by trimming any input in the backend and not allowing for blank inputs.
</p>
<hr>

<p><strong>Function Number:</strong> 9</p>
<p><strong>Function Name:</strong>  Login User</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/login.php">
http://students.cs.umt.edu/~pg216938/db-design-project/login.php</a></p>
<p><strong>Function Type:</strong> Security Function</p>
<p><strong>Description:</strong>
This function allows the user to login into their dashboard.</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, roles</p>
<p><strong>Sample Input:</strong> Login: paulo@email.com Pass: 1234</p>
<p><strong>Sample Output:</strong> You are now redirected and logged in.</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because 
now I can pass around the user_id using sessions variables and only show information based on whatever user is currently logged in. 
Even though, it's a simple function, if a user is not logged in, they can view any pages in the application because I am checking to see
if an ID was set in the session. Also, this functions checks for errors by querying the users email and password and checking to see if they match,
if they do let them in, otherwise show a message telling them they have the wrong information.
<hr>

<p><strong>Function Number:</strong> 10</p>
<p><strong>Function Name:</strong>  Edit Profile</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/edit_profile.php?id=1">
http://students.cs.umt.edu/~pg216938/db-design-project/edit_profile.php?id=1</a><br>For testing purpose, link goes to user of id = 1, but all users have the function.</p> 
<p><strong>Function Type:</strong> Update Function</p>
<p><strong>Description:</strong>
This function allows the user to enter their personal information</p>
<p><strong>Primary Users:</strong>  Users </p>
<p><strong>Tables affected: </strong> users, personal_information, roles, fitness_level</p>
<p><strong>Sample Input:</strong> DOB: 06/16/1993, Gender: Male, Height: 100, Weight: 190, Fitness_Level: Beginner</p>
<p><strong>Sample Output:</strong> Your information is now updated.</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because 
it allows the application to gather some data about the user. I am querying different tables because 
personal_information have relationships with fitness_level, and users.
This function handles error checking by trimming inputs in the backend and requiring input fields not to be blank.
<hr>

<p><strong>Function Number:</strong> 11</p>
<p><strong>Function Name:</strong>  Drop DB, Create DB, Create DB Tables, Seed DB Tables</p>
<p><strong>URL:</strong> <a href="http://students.cs.umt.edu/~pg216938/db-design-project/user.php">
http://students.cs.umt.edu/~pg216938/db-design-project/user.php</a><br>General Functions Menu Dropdown.</p> 
<p><strong>Function Type:</strong> Maintenance Function</p>
<p><strong>Description:</strong>
These function allows the admin to reset all information in the DB</p>
<p><strong>Primary Users:</strong>  Admins </p>
<p><strong>Tables affected: </strong> Entire DB // All Tables</p>
<p><strong>Sample Input:</strong> Click the buttons in order given.</p>
<p><strong>Sample Output:</strong> Fresh seeded DB</p>
<p><strong>Notes:</strong> 
This function is particularly interesting because it allow me to simply reset my DB and seed it with corrected data 
once I made a mistake during development.
<hr>

</div>
</div>



<?php require_once("includes/db_close_connection.php");  ?>
<?php include("includes/layouts/footer.php"); ?>