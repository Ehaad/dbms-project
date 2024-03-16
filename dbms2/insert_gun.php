<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert-gun</title>


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
<h1>successfully added!</h1>
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

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to hold column names and values
    $columns = [];
    $values = [];

    // Extract submitted values and sanitize them
    foreach ($_POST as $key => $value) {
        // Prevent SQL injection by escaping special characters
        $columns[] = $conn->real_escape_string($key);
        $values[] = $conn->real_escape_string($value);
    }

    // Prepare SQL query to insert the item into the database
    $table_name = 'gun'; // Replace 'your_table_name' with the actual table name
    $columns_str = implode(', ', $columns);
    $values_str = "'" . implode("', '", $values) . "'";
    $sql = "INSERT INTO gun ($columns_str) VALUES ($values_str)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo " .";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


   
}

// Close connection
$conn->close();
?>
