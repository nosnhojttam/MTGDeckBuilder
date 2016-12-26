<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$username = $_POST['username'];

//following query prevents SQL injection
$sql = "DELETE FROM users
        WHERE username = :username";

$namedParameters = array();
$namedParameters[":username"] = $username;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);

echo "User " . $username . " was deleted!<br>";
echo "<a href='addUser.php'>BACK!</a>";


?>