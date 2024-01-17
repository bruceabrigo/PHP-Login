<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

<?php

// connect to sql cluster with mysqli
$connect = mysqli_connect(
    'db',
    'php_docker',
    'password',
    'php_docker'
);

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

// create a variable that calls to the users data table
$table_name = 'users';

// Hash the password (for security)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// create an INSERT INTO query to create a new User in the users table
$create_user = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashedPassword')";

// run a connection query response
$response = mysqli_query($connect, $create_user);

if ($response) {
    echo "<h3>User created Successfully!</h3>";
} else {
    echo "<h3>Error creating user...</h3>";
}

mysqli_close($connect);

?>

<h2>User Registration Form</h2>

<form method="post" action="">
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
