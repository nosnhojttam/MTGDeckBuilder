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

if(!(empty($record))){
    header('Location: addUser.php');
}

//following query prevents SQL injection
$sql1 = "INSERT INTO users(userId, username, password, admin) 
        VALUES (NULL, :username, :password, :admin);";

$namedParameters1 = array();
$namedParameters1[":username"] = $username;
$namedParameters1[":password"] = $password;
$namedParameters1[":admin"] = $admin;

$statement = $conn->prepare($sql1);
$statement->execute($namedParameters1);

header('Location: findCards.php');  //redirects to another program

?>