<!DOCTYPE html>
<html>
<head>
    <title>Loadout</title>
 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            background-image: url('gunbg.jpg');
            background-repeat:no-repeat;
            background-size:cover;
        }
        .container {
            max-width: 800px;
            margin: 90px auto;
            padding: 20px;
            background-color: darkgray;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: black;
            background-color: gray;
            padding:30px;
            border-radius: 20px;
        }
        .button-container {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .button-container button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: black;
            color: #fff;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: gray;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: gray;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color:black;
        }
        .values-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .values-row .value-cell {
            flex: 1 1 auto;
        }
        .logout-container {
            text-align: center;
            margin-top: 20px;
        }
        .logout-container button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #dc3545;
            color: #fff;
            cursor: pointer;
        }
        .logout-container button:hover {
            background-color: #c82333;
        }
        .add-value-container {
            text-align: center;
            margin-top: 20px;
            display:flex;
            padding:30px;
        }
        .add-value-container input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            display:flex;
        }
        .add-value-container input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
        }
       
        .add-value-container input[type="submit"]:hover {
            background-color: #218838;
        }
        .search-container{
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: black;
            color: #fff;
            cursor: pointer;
        }
        .form{
            background-color:white;
            
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ARMS DATABASE</h1>
        <hr>

        <h2>QUICK ACTION</h2>

        

        <div class="button-container">
            <?php
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

            // Fetch tables from the database
            $tables_query = "SHOW TABLES";
            $tables_result = $conn->query($tables_query);

            // Check if tables exist
            if ($tables_result->num_rows > 0) {
                // Loop through each table
                while($row = $tables_result->fetch_assoc()) {
                    $table_name = $row["Tables_in_$database"];
                    // Create a button for each table
                    echo "<form method='post' action=''>";
                    echo "<button type='submit' name='table' value='$table_name'>$table_name</button>";
                    echo "</form>";
                }
            } else {
                echo "No tables found.";
            }

            ?>
        </div>
        <hr>

        <div class="search-container">
            <form method="post" action="">
                <input type="text" name="search_query" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
        </div>

        <?php
// Check if a search query is submitted
if (isset($_POST['search_query'])) {
    $search_query = $conn->real_escape_string($_POST['search_query']);

    // Construct and execute the SQL query to fetch filtered results
    $sql = "SELECT * FROM gun WHERE model LIKE '%$search_query%'";
    $result = $conn->query($sql);

    // Display filtered results in the table
    if ($result->num_rows > 0) {
        // Display the table header
        echo "<h3>Search Results:</h3>";
        echo "<table>";
        // Display table header
        echo "<tr><th>gun_id</th><th>Model</th><th>Manufacturer</th><th>Type</th><th>Caliber</th></tr>";
        // Display table rows with filtered data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['gun_id']."</td>";
            echo "<td>".$row['model']."</td>";
            echo "<td>".$row['manufacturer']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['caliber']."</td>";
            echo "</tr>";
        }
        // Close the table
        echo "</table>";
    }   else {
          echo " ";
    } 


    


    $sql = "SELECT * FROM ammo WHERE caliber LIKE '%$search_query%'";
    $result = $conn->query($sql);

    // Display filtered results in the table
    if ($result->num_rows > 0) {
        // Display the table header
        echo "<h3>Search Results:</h3>";
        echo "<table>";
        // Display table header
        echo "<tr><th>ammo_id</th><th>type</th><th>caliber</th><th>quantity_in_stock</th><th>price_per_round</th></tr>";
        // Display table rows with filtered data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['ammo_id']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['caliber']."</td>";
            echo "<td>".$row['quantity_in_stock']."</td>";
            echo "<td>".$row['price_per_round']."</td>";
            echo "</tr>";
        }
        // Close the table
        echo "</table>";
    } else {
        echo ".";
    }


    $sql = "SELECT * FROM equipment WHERE name LIKE '%$search_query%'";
    $result = $conn->query($sql);

    // Display filtered results in the table
    if ($result->num_rows > 0) {
        // Display the table header
        echo "<h3>Search Results:</h3>";
        echo "<table>";
        // Display table header
        echo "<tr><th>equipment_id</th><th>name</th><th>type</th><th>manufacturer</th><th>price</th></tr>";
        // Display table rows with filtered data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['equipment_id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['manufacturer']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "</tr>";
        }
        // Close the table
        echo "</table>";
    } else {
        echo " .";
    }



    $sql = "SELECT * FROM country WHERE name LIKE '%$search_query%'";
    $result = $conn->query($sql);

    // Display filtered results in the table
    if ($result->num_rows > 0) {
        // Display the table header
        echo "<h3>Search Results:</h3>";
        echo "<table>";
        // Display table header
        echo "<tr><th>country_id</th><th>name</th><th>continent</th><th>government_type</th></tr>";
        // Display table rows with filtered data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['country_id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['continent']."</td>";
            echo "<td>".$row['government_type']."</td>";
            echo "</tr>";
        }
        // Close the table
        echo "</table>";
    } else {
        echo " .";
    }



    $sql = "SELECT * FROM sales WHERE date_of_sale LIKE '%$search_query%'";
    $result = $conn->query($sql);

    // Display filtered results in the table
    if ($result->num_rows > 0) {
        // Display the table header
        echo "<h3>Search Results:</h3>";
        echo "<table>";
        // Display table header
        echo "<tr><th>sale_id</th><th>ammo_id</th><th>gun_id</th><th>country_id</th></tr><th>equipment_id</th></tr><th>quantity_sold</th></tr><th>date_of_sale</th></tr><th>total_price</th></tr>";
        // Display table rows with filtered data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['country_id']."</td>";
            echo "<td>".$row['equipment_id']."</td>";
            echo "<td>".$row['ammo_id']."</td>";
            echo "<td>".$row['gun_id']."</td>";
            echo "<td>".$row['sale_id']."</td>";
            echo "<td>".$row['quantity_sold']."</td>";
            echo "<td>".$row['date_of_sale']."</td>";
            echo "<td>".$row['total_price']."</td>";
            echo "</tr>";
        }
        // Close the table
        echo "</table>";
    } else {
        echo " .";
    }


    ///////////////////////////////////
 // SQL query to calculate total quantity of guns sold
$sql = "SELECT SUM(quantity_sold) AS total_guns_sold FROM sales WHERE gun_id IS NOT NULL";

// Execute the query
$result = $conn->query($sql);

// Check if query execution was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    
    // Output the total quantity of guns sold
    $total_guns_sold = $row['total_guns_sold'];
    echo "Total Quantity of Guns Sold: " . $total_guns_sold;
} else {
    // Output an error message if the query fails
    echo "Error: " . $conn->error;
}


//////////////////////////////////////////////
// Query to calculate average sales
$sql = "SELECT AVG(total_price) AS average_sales FROM sales";
$result = $conn->query($sql);

// Check if query executed successfully
if ($result) {
    // Fetch the average sales value
    $row = $result->fetch_assoc();
    $average_sales = $row["average_sales"];
    echo "Average Sales: $" . number_format($average_sales, 2);
} else {
    echo "Error: " . $conn->error;
}
////////////////////////////////////////////////
// SQL query to calculate total sale revenue
$sql = "SELECT SUM(total_price) AS total_revenue FROM sales";

// Execute the query
$result = $conn->query($sql);

// Check if query execution was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    
    // Output the total revenue
    $total_revenue = $row['total_revenue'];
    echo "Total Sale Revenue: $" . number_format($total_revenue, 2);
} else {
    // Output an error message if the query fails
    echo "Error: " . $conn->error;
}




    
}
?>
<br>
 
 <form method="post" action="join_table.php">
        <button type="submit" name="join_tables">GUN & AMMO</button>
    </form>
    <br>
    <form method="post" action="gun_sold.php">
        <button type="submit" name="query_button">QUANTITY OF GUN SOLD</button>
    </form>

        <?php
        // Check if a table button is clicked
        if(isset($_POST['table'])) {
            $table_name = $_POST['table'];

            // Create a new connection
            $conn = new mysqli("localhost", "root", "admin", "arms");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch attributes of the selected table
            $attributes_query = "DESCRIBE $table_name";
            $attributes_result = $conn->query($attributes_query);

            // Fetch values for each attribute
            echo "<h3>Values of Table: $table_name</h3>";
            echo "<table>";
            foreach($attributes_result as $attribute_row) {
                $attribute_name = $attribute_row['Field'];
                $values_query = "SELECT $attribute_name FROM $table_name";
                $values_result = $conn->query($values_query);
                if ($values_result->num_rows > 0) {
                    echo "<tr><th>$attribute_name</th></tr>";
                    echo "<tr class='values-row'>";
                    while($value_row = $values_result->fetch_assoc()) {
                        echo "<td class='value-cell'>".$value_row[$attribute_name]."</td>";
                    }
                    echo "</tr>";
                } else {
                    echo "<tr><td>No values found for $attribute_name.</td></tr>";
                }
            }
            echo "</table>";

            // Close connection
            $conn->close();
        }
        ?>
        <hr>

        <div class="add-value-container">
            <h3>Add Item: for guns</h3>
            <form method="post" action="insert_gun.php">
                <?php
                // Reconnect to get attributes for adding values
                $conn = new mysqli($servername, $username, $password, $database);
                // Fetch attributes of the selected table again
                $attributes_query = "DESCRIBE $table_name";
                $attributes_result = $conn->query($attributes_query);
                foreach($attributes_result as $attribute_row) {
                    $attribute_name = $attribute_row['Field'];
                    // Display input fields for each attribute
                    echo "<input type='text' name='$attribute_name' placeholder='$attribute_name' required><br>";
                }
                ?>
                <input type="submit" value="Add Item">
            </form>
            <h3>Delete Gun</h3>
            <form method="post" action="delete_gun.php">
                <label for="delete_id">Enter ID of Gun to Delete:</label>
                <input type="text" name="delete_id" id="delete_id" required>
                <input type="submit" value="Delete">
            </form>
        </div>
        <div class="add-value-container">
            <h3>Add Item: for ammo</h3>
            <form method="post" action="insert_ammo.php">
                <?php
                // Reconnect to get attributes for adding values
                $conn = new mysqli($servername, $username, $password, $database);
                // Fetch attributes of the selected table again
                $attributes_query = "DESCRIBE $table_name";
                $attributes_result = $conn->query($attributes_query);
                foreach($attributes_result as $attribute_row) {
                    $attribute_name = $attribute_row['Field'];
                    // Display input fields for each attribute
                    echo "<input type='text' name='$attribute_name' placeholder='$attribute_name' required><br>";
                }
                ?>
                <input type="submit" value="Add Item">
            </form>
            <h3>Delete ammo</h3>
            <form method="post" action="delete_ammo.php">
                <label for="delete_id">Enter ID of ammo to Delete:</label>
                <input type="text" name="delete_id" id="delete_id" required>
                <input type="submit" value="Delete">
            </form>
        </div>
        <div class="add-value-container">
            <h3>Add Item: for sales</h3>
            <form method="post" action="insert_sales.php">
                <?php
                // Reconnect to get attributes for adding values
                $conn = new mysqli($servername, $username, $password, $database);
                // Fetch attributes of the selected table again
                $attributes_query = "DESCRIBE $table_name";
                $attributes_result = $conn->query($attributes_query);
                foreach($attributes_result as $attribute_row) {
                    $attribute_name = $attribute_row['Field'];
                    // Display input fields for each attribute
                    echo "<input type='text' name='$attribute_name' placeholder='$attribute_name' required><br>";
                }
                ?>
                <input type="submit" value="Add Item">
            </form>
            <h3>Delete sales</h3>
            <form method="post" action="delete_sales.php">
                <label for="delete_id">Enter ID of sales to Delete:</label>
                <input type="text" name="delete_id" id="delete_id" required>
                <input type="submit" value="Delete">
            </form>
        </div>

        <div class="logout-container">
            <form method="post" action="login.php">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
