<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    h1{
        justify-content:center;
        text-align:center;
        margin:100px 0 0;
        display:flex;
        padding:30px;


    }
    .button{
        display:flex;
        /* background: ; */
        justify-content:center;
        margin:50px 0 0;
        padding:50px;

    }
</style>
<body>
    <h1>Gun deleted successfully!</h1>
   <div class="button">
    <center><button onclick="history.back()">Go Back</button></center>
    </div>
</body>
</html>

<?php
// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = "admin"; // Change this to your MySQL password
$database = "arms"; // Change this to your MySQL database name

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the input
    $delete_id = $conn->real_escape_string($_POST['delete_id']);

    // Prepare SQL query to delete the item from the database
    $sql = "DELETE FROM ammo WHERE ammo_id = $delete_id"; // Assuming 'id' is the primary key column

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo " .";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
