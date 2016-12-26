<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

if(!isset($_SESSION['mtgUsername'])){
  echo "YOU MUST BE LOGGED IN TO DO THAT!";
  exit;
}

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("mtg");

$cards = $_POST['cards'];
//print_r($cards);

echo "<span>Cards to add:<br>";
foreach($cards as $key => $value){
    echo "<img src='" . $value['img'] . "'</img>";
}
echo "</span><br>";

exit;

?>
