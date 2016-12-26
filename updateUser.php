<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$username = $_POST['username'];
$password = sha1($_POST['password1']);
$admin = $_POST['admin'];
if($admin == "y"){
    $admin = 1;
}
else{
    $admin = 0;
}

//following query prevents SQL injection
$sql = "UPDATE users
        SET password = :password
        AND admin = :admin 
        WHERE username = :username";

$namedParameters = array();
$namedParameters[":username"] = $username;
$namedParameters[":password"] = $password;
$namedParameters[":admin"] = $admin;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);

echo "User " . $username . " updated!";

?>