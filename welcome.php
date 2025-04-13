<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: loginPage.html");//redirect if not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome to Agro_Connect!</h2>
    <p>You are logged in as: <strong><?php echo $_SESSION['username']?></strong></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>