<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

<?php
$connect = mysqli_connect(
    'db', 
    'php_docker', 
    'password', 
    'php_docker'
);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") { # check for POST request method
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $table_name = 'users';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $create_user = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashedPassword')";
    $response = mysqli_query($connect, $create_user);

    if ($response) { # if the form is completed successfully display a success message
        echo "<p style='color: green;'>User Created Successfully</p>";
        echo "<p style='color: blue;'>Login</p>";
    } else { # otherwise display an error
        echo "<p style='color: red;'>Error creating new user: " . mysqli_error($connect) . "</p>";
    }
}

mysqli_close($connect);
?>

<h2>User Registration Form</h2>

<form method="POST" action="">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
