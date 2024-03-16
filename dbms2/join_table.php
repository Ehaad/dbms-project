<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Tables</title>
    <style>
        .join {
            padding: 30px;
            display: flex;
            background-color: white;
            margin: 20px 300px 300px;
            justify-content: center;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .button{

           margin:auto;
        }
    </style>
</head>
<body>
    <h1>Query: SELECT gun.model, ammo.caliber FROM gun INNER JOIN ammo ON gun.gun_id = ammo.ammo_id</h1>
   
    <div class="join">
        <?php
        // Check if the join tables button is clicked
        if (isset($_POST['join_tables'])) {
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

            // SQL query to join tables and fetch data
            $sql = "SELECT gun.model, ammo.caliber
                    FROM gun
                    INNER JOIN ammo ON gun.gun_id = ammo.ammo_id";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output table headers
                echo "<table>";
                echo "<tr><th>Model</th><th>Caliber</th></tr>";

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["caliber"] . "</td>";
                    echo "</tr>";
                }

                // Close the table
                echo "</table>";
            } else {
                echo "0 results";
            }

            // Close connection
            $conn->close();
        }
        ?>
        
    </div>
    <center><button onclick="history.back()">Go Back</button></center>
    
</body>
</html>
