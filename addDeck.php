<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

if(!isset($_SESSION['mtgUsername'])){
  echo "YOU MUST BE LOGGED IN TO DO THAT!";
  exit;
}

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$deckName = $_POST['deckName'];
$username = $_SESSION['mtgUsername'];
$password = $_SESSION['mtgPassword'];

$sql = "SELECT *
        FROM users
        WHERE username = :username
        AND password= :password";
        
$namedParameters = array();
$namedParameters[":username"] = $username;
$namedParameters[":password"] = $password;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$record = $statement->fetch(PDO::FETCH_ASSOC);

if(empty($record)){
    echo "ERROR";
}



$userId = $record['userId'];


$sql1 = "INSERT INTO decks
         VALUES(NULL, :deckName, :userId)";

//echo "<br>" . $deckName . " " . $userId . "<br>";

//echo $sql1 . "<br>";


$namedParameters1 = array();
$namedParameters1[":deckName"] = $deckName;
$namedParameters1[":userId"] = $userId;

$statement = $conn->prepare($sql1);
$statement->execute($namedParameters1);

echo "Deck " . $deckName . " was added!";

?>
