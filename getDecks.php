<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

if(!isset($_SESSION['mtgUsername'])){
  echo "<a href='login.php'>Login here</a>";
  exit;
}

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$username = $_SESSION['mtgUsername'];
$password = $_SESSION['mtgPassword'];  // hash("sha1", $_POST['password']);

//following query prevents SQL injection
$sql = "SELECT * 
        FROM users
        RIGHT JOIN decks
        ON users.userId = decks.userId 
        WHERE users.username = :username
        AND users.password = :password";

$namedParameters = array();
$namedParameters[":username"] = $username;
$namedParameters[":password"] = $password;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$records = $statement->fetchALL(PDO::FETCH_ASSOC);
//print_r($record);
    
    if (empty($records) && !isset($_SESSION['mtgUsername'])) {  //it didn't find any record
        
        echo "Wrong username or password!";
        echo "<a href='login.php'> Try again </a>";
        
    } 
    else if(empty($records)){
        echo "No decks to be found! <a href='editDecks.php'>Create one here</a>";
    }
    else{
        echo "<span>Which deck would you like to add these cards to?</span>";
        echo "<select id='selectDecks'>";
        foreach($records as $record){
            echo "<option id='" . $record['deckId'] . "' value='" . $record['deckId'] . "'>" . $record['deckName'] . "</option>";
        }
        echo "</select><br>";
        echo "<button id='addToDeck' onclick='addCardsToDeck()'>Add Cards</button>";
    }
    
    
?>
