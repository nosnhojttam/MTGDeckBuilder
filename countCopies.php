<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$username = $_SESSION['mtgUsername'];
$password = $_SESSION['mtgPassword'];  // hash("sha1", $_POST['password']);
$deckId = $_POST['deckId'];



//following query prevents SQL injection
$sql = "SELECT SUM(cards.copies) as countCards, decks.deckId
        FROM decks
        INNER JOIN cards
        ON decks.deckId = cards.deckId 
        INNER JOIN users
        ON decks.userId = users.userId
        WHERE users.username = :username
        AND users.password = :password
        GROUP BY cards.deckId";

$namedParameters = array();
$namedParameters[":username"] = $username;
$namedParameters[":password"] = $password;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$records = $statement->fetchAll(PDO::FETCH_ASSOC);



    
    if (empty($records)) {  //it didn't find any record
        
        echo "ERROR";
        echo "<a href='login.php'> Try again </a>";
        
    } 
    else{
        foreach($records as $record){
            if($record['deckId'] == $deckId){
                echo "<br>Total number of cards in deck: " . $record['countCards'];
            }
        }
    }
    
    
?>
