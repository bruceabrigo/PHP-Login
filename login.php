<?php
// start a new session 
// new user session will start when php script is called
session_start();

// create a connection to sqli 
$connect = mysqli_connect(
    'db', 
    'php_docker', 
    'password', 
    'php_docker'
);

// connection error handling
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// create a check to verify REQUEST METHOD is POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // check db for usersnames in the db
    $check_user = "SELECT * FROM users WHERE username='$username'";

    // store check user with a result variable containing a mysqli query
    $result = mysqli_query($connect, $check_user);

    // run a conditional to ensure a positive db connection
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            
            // Display welcome message directly on the login page
            echo "<h2>Welcome, $username!</h2>";
            
            exit(); // Exit to prevent further execution
        } else { # login error handling
            echo "<p style='color: red;'>Invalid username or password</p>";
        }
    } else { # db connection error handling
        echo "<p style='color: red;'>Error querying database: " . mysqli_error($connect) . "</p>";
    }
}

# close connection to db after completing authentication
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>

<h2>User Login Form</h2>

<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

</body>
</html>
