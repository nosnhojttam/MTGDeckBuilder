<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

if(!isset($_SESSION['mtgUsername'])){
  echo "YOU MUST BE LOGGED IN TO DO THAT!";
  exit;
}

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$deckName = $_POST['deckName'];
$deckId = $_POST['deckId'];

$sql = "UPDATE decks
        SET deckName = :deckName
        WHERE deckId = :deckId";
        
$namedParameters = array();
$namedParameters[":deckName"] = $deckName;
$namedParameters[":deckId"] = $deckId;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);

echo "Deck was renamed to " . $deckName;

?>
