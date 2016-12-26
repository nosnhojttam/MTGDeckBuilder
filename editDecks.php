<?php
    session_start();

    if (!isset($_SESSION['mtgUsername'])) {
        header('Location: login.php'); //sends users back to login screen if they haven't logged in
        exit;
    }
    
    function loggedinAdmin(){
        if($_SESSION['mtgAdmin'] == 1){
            return "block";
        }
        return "none";
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Edit Decksx</title>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>

        
        <style>
            #loggedinadmin{
                display: <?= loggedinadmin() ?>;
            }
        </style>
        
        <script>
            
            $.ajax({
                type: "get",
                url: "getDecksToEdit.php",
                dataType: "html",
                data: {  },
                success: function(data,status) {
                    $("#decks").html(data);
                    
                },
                complete: function(data,status) { //optional, used for debugging purposes

                }
              });//AJAX 

            function editDeck(){
                
                var deckId = $("#selectDeck").val();
                
                $.ajax({
                    type: "post",
                    url: "getCardsFromDeck.php",
                    dataType: "html",
                    data: { deckId: deckId },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
            }
            
            function countCards(){
                
                var deckId = $("#selectDeck").val();
                
                $.ajax({
                    type: "post",
                    url: "countCardsInDeck.php",
                    dataType: "html",
                    data: { deckId: deckId },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
            }
            
            function countAllCards(){
                
                var deckId = $("#selectDeck").val();
                
                $.ajax({
                    type: "post",
                    url: "countCopies.php",
                    dataType: "html",
                    data: { deckId: deckId },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
            }
            
            function getAvg(){
                
                var deckId = $("#selectDeck").val();
                
                $.ajax({
                    type: "post",
                    url: "getAvgCopy.php",
                    dataType: "html",
                    data: { deckId: deckId },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
            }
            
            function addDeck(){
                var newForm = "<input type='text' id='deckName' name='deckName'><br>";
                newForm += "<button id='addNewDeck' onclick='addNewDeck()'>Add Deck</button>";
                
                $("#decks").html(newForm);
            }
            
            function addNewDeck(){
                var deckName = $("#deckName").val();
                
                $.ajax({
                    type: "post",
                    url: "addDeck.php",
                    dataType: "html",
                    data: { deckName: deckName },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
                
            }
            
            
            var cards = {
            };
            
            function removeCard(card, cardID, imageURL){
                $(card).css("opacity", "0.5");
                
                
                cards[cardID] = {
                    img: imageURL, 
                    count: 1
                }

                console.log(cards);
                  
            }
            
            function removeCards(){
                $.ajax({
                    type: "post",
                    url: "removeCardsFromDeck.php",
                    dataType: "html",
                    data: { cards: cards },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
                
            }
            
            function renameDeck(){
                
                var newForm = "<input type='text' id='newDeckName' name='newDeckName'><br>";
                newForm += "<button id='rename' onclick='rename()'>Submit</button>";
                
                $("#cards").html(newForm);
            }
            
            function rename(){
                var deckId = $("#selectDeck").val();

                var deckName = $("#newDeckName").val();
                
                $.ajax({
                    type: "post",
                    url: "renameDeck.php",
                    dataType: "html",
                    data: { deckId, deckId, deckName: deckName },
                    success: function(data,status) {
                        $("#cards").html(data);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX
            }
            

        </script>
        
    </head>
    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">MTG DECK BUILDER</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="findCards.php">Find Cards</a></li>
                <li><a href="editDecks.php" id="loggedin">Edit Decks</a></li>
                <li><a href="addUser.php" id="loggedinadmin">Add User</a></li>
              </ul>
              <form class="navbar-form navbar-left">
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php" id="loggedin">Logout</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
        <br><br>
        
        <div id="decks">
        </div>
        
        <div id="cards">
        </div>
        
        
    </body>
</html>