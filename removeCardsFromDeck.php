<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$cards = $_POST['cards'];
$deckId = $_POST['deckId'];


$sql = "DELETE FROM cards
        WHERE cardID in (";
$sqlInner = "";

foreach($cards as $key => $value){
    
    if($sqlInner != ""){
        $sqlInner .= ", ";
    }
    //$sqlInner .= "SELECT " . $key . ", '" . $value['img'] . "', " . $value['count'] . ", " . $deckId;
    $sqlInner .= $key;
}
$sql .= $sqlInner . ");";

$statement = $conn->prepare($sql);
$statement->execute();

echo "<span>Cards removed.</span>";

?>