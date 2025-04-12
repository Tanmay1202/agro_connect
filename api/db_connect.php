<?php 
$host = 'localhost:3307';//port that which the phpmyadmin is running
$user = 'root';//default user
$pass = '';//no password needed
$db = 'pest_alerts'; //the db created for this project

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connect failed: ". $conn->connect->error);
}
?>