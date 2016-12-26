<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

if(!isset($_SESSION['mtgUsername'])){
  echo "YOU MUST BE LOGGED IN TO DO THAT!";
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

    if (empty($records)) {  //it didn't find any record
    
        echo "<span>No decks here yet!</span><br>";
        echo "<button id='newDeck' onclick='addDeck()'>Add New Deck</button><br>";
        
    } 
    else{
        echo "<span>Your decks:</span>";
        echo "<select id='selectDeck'>";
        foreach($records as $record){
            echo "<option id='" . $record['deckId'] . "' value='" . $record['deckId'] . "'>" . $record['deckName'] . "</option>";
        }
        echo "</select><br><br>";
        echo "<button id='addToDeck' onclick='editDeck()'>Get Deck</button><br>";
        echo "<button id='renameDeck' onclick='renameDeck()'>Rename Deck</button><br><br>";
        echo "<button id='countCards' onclick='countCards()'>Count Unique Cards</button><br>";
        echo "<button id='countAllCards' onclick='countAllCards()'>Total Copies of Cards</button><br>";
        echo "<button id='avg' onclick='getAvg()'>Average Number of Copies</button><br><br>";
        
        echo "<button id='newDeck' onclick='addDeck()'>Add New Deck</button><br><br>";
    }
    
    
?>
