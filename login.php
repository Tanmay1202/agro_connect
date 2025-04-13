<?php
session_start();//must be the first line before any ouput to initialize seesion
include 'api/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    if($stored_password && $password === $stored_password)
    {
        $_SESSION['username'] = $username;//store username in session
        echo "Login successful! <a href='index.html'>Go to dashboard</a> | <a href='logout.php'>Logout</a>";
    }
    else
    {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}

?>