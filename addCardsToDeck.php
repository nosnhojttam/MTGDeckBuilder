<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$cards = $_POST['cards'];
$deckId = $_POST['deckId'];


$sql = "INSERT cards(cardID, imageURL, copies, deckID) ";
$sqlInner = "";
foreach($cards as $key => $value){
    
    if($sqlInner != ""){
        $sqlInner .= " UNION ALL ";
    }
    $sqlInner .= "SELECT " . $key . ", '" . $value['img'] . "', " . $value['count'] . ", " . $deckId;
}
$sql .= $sqlInner;

$statement = $conn->prepare($sql);
$statement->execute();

echo "<span>Cards added to the deck!</span>";

?>