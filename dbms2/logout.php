<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Arms Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .logout-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logout-container a {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }
        .logout-container a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>LOAD THE GUN!</h1>
        <div class="logout-container">
            <a href="login.php">Logout</a>
        </div>
        <!-- Add your dashboard content here -->
    </div>
</body>
</html>
