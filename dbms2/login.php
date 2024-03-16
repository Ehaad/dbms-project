<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy credentials (replace with your authentication logic)
    $valid_username = 'root';
    $valid_password = 'admin';

    // Check if username and password match
    if ($username === $valid_username && $password === $valid_password) {
        // Redirect to dashboard or another page on successful login
        header("Location: database_dashboard.php");
        exit();
    } else {
        // Redirect back to login page with error message
        header("Location: login.html?error=true");
        exit();
    }
}
?>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $errors = [];
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no errors, proceed to signup
    if (empty($errors)) {
        // Database connection parameters
        $servername = "localhost";
        $db_username = "root";
        $db_password = "admin";
        $database = "arms";

        // Create a PDO connection
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL statement to insert user data into the database
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            // Execute the statement
            $stmt->execute();

            echo "Signup successful!";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
