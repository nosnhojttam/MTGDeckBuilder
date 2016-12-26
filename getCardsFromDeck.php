<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$username = $_SESSION['mtgUsername'];
$password = $_SESSION['mtgPassword'];  // hash("sha1", $_POST['password']);
$deckId = $_POST['deckId'];


//following query prevents SQL injection
$sql = "SELECT * 
        FROM decks
        INNER JOIN cards
        ON decks.deckId = cards.deckId 
        INNER JOIN users
        WHERE users.username = :username
        AND users.password = :password";

$namedParameters = array();
$namedParameters[":username"] = $username;
$namedParameters[":password"] = $password;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$records = $statement->fetchAll(PDO::FETCH_ASSOC);



    $count = 0;
    if (empty($records)) {  //it didn't find any record
        
        echo "ERROR";
        echo "<a href='login.php'> Try again </a>";
        
    } 
    else{
        echo "<br>";
        foreach($records as $record){
            if($record['deckID'] == $deckId){
                $count++;
                echo "<button id='cardButton" . $count . "'><img src='" . $record['imageURL'] . "' width='200' id='card" . $count . "' onclick='removeCard(\"#card" . $count .  "\", " . $record['cardID'] . ", \"" . $record['imageURL'] . "\")'></button>";
                //echo "<span>Number of copies: " . $record['copies'] . "</span>";
                
            }
        }
        echo "<br><button id='removeCards' onclick='removeCards()'>Remove Cards</button>";
    }
    
    
?>
