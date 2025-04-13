<?php

include 'api/db_connect.php';// reusing the code written in this file, leveraging a feature i.e. provided by php enabling the users to reuse the same code again and again by just including a certian file with that code in it
//tl;dr -> it basically sets up the database connection
if($_SERVER['REQUEST_METHOD'] == 'POST') {//checks if form was submitted
    $username = trim($_POST['name'] ?? '');//retrieves data based on name attributes in sigunpPage.html
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");//creates a safe sql query with ? placeholders
    $stmt->bind_param("sss", $username, $email, $password);//binfs the variables in (s for string) to prevent sql injection

    if($stmt->execute())//inserts data, success shows a message, failure shows an error
    {
        echo "<a href='loginPage.html'>Login in here.</a>";
    }
    else
    {
        echo "ERROR: ". $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>