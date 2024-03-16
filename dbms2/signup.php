<!DOCTYPE html>
<html>
<head>
    <title>Signup - Arms Database</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('gunbg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            max-width: 400px;
            margin: 190px auto;
            padding: 20px;
            background-color: gray;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #020202;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #090b0d;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: lightgray;
            color:black;
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
        .success-message {
            color: green;
            font-size: 14px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Signup</h1>
        <?php if(isset($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="username" placeholder="Username" value="<?php if(isset($username)) { echo $username; } ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php if(isset($email)) { echo $email; } ?>" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Signup">
        </form>
        <div class="login-link">
            <a href="login.html">Already have an account? Login here</a>
        </div>
    </div>

</body>
</html>
