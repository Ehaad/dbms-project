<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grouping and Aggregation</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    .gun{
        padding: 30px;
        display:flex;
        background-color:white;
        margin: 0px 300px 300px;
        justify-content:center;
        border-radius: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2{
        text-align:center;
        margin-top:50px;
    }
</style>
<body>
    <h2>Total Quantity of Guns Sold by Model</h2>
    <div class="gun">
        <?php
        // Check if the button is clicked
        if (isset($_POST['query_button'])) {
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

            // SQL query to group by gun model and calculate total quantity sold
            $sql = "SELECT g.model, SUM(s.quantity_sold) AS total_quantity_sold
                    FROM gun AS g
                    INNER JOIN sales AS s ON g.gun_id = s.gun_id
                    GROUP BY g.model";
            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output table header
                echo "<table>";
                echo "<tr><th>Model</th><th>Total Quantity Sold</th></tr>";

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["model"] . "</td><td>" . $row["total_quantity_sold"] . "</td></tr>";
                }

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

    <!-- Button to trigger the query -->
</body>
</html>
