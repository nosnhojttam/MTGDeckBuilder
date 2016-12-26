<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$username = $_POST['username'];
$password = sha1($_POST['password']);  // hash("sha1", $_POST['password']);

//following quere doesn't prevent SQL injection
// $sql = "SELECT * 
//         FROM admin
//         WHERE username = '$username'
//           AND password = '$password'";

//following query prevents SQL injection
$sql = "SELECT * 
        FROM users
        WHERE username = :username
          AND password = :password";

$namedParameters = array();
$namedParameters[":username"] = $username;
$namedParameters[":password"] = $password;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$record = $statement->fetch(PDO::FETCH_ASSOC);
//print_r($record);

    if (empty($record)) {  //it didn't find any record
        
        echo "Wrong username or password!";
        echo "<a href='login.php'> Try again </a>";
        
    } else {
        
        $_SESSION['mtgUsername'] = $record['username'];
        $_SESSION['mtgPassword'] = $record['password'];
        $_SESSION['mtgAdmin'] = $record['admin'];
        
        header('Location: findCards.php');  //redirects to another program        
        
    }
    

?>