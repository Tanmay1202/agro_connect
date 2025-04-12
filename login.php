<?php

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
        echo "Login successful! <a href='index.html'> Go to Home </a>";
    }
    else
    {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}

?>