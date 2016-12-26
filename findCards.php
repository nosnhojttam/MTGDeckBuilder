<?php
    session_start();
    
    function loggedinAdmin(){
        if($_SESSION['mtgAdmin'] == 1){
            return "block";
        }
        return "none";
    }
    
    function loggedin(){
        if(!isset($_SESSION['mtgUsername'])){
            return "none";
        }
        return "block";
    }
    
    function loggedout(){
        if(!isset($_SESSION['mtgUsername'])){
            return "block";
        }
        return "none";
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <title>FINAL PROJECT</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        
        <style>
            #loggedinadmin{
                display: <?= loggedinadmin() ?>;
            }
            #loggedin{
                display: <?= loggedin() ?>;
            }
            #loggedout{
                display: <?= loggedout() ?>;
            }
            
        </style>
    
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
        
        <script>

            var currentPage = 1;
            
            function nextPage(){
                currentPage++;
                getCards(currentPage);
            }
        
            function getCards(currentPage){
                count = 0;
                $.ajax({
                    type: "get",
                    url: "https://api.magicthegathering.io/v1/cards?page=" + currentPage,
                    dataType: "json",
                    data: { type: $("#type").val(), colors:$("#colors:checked").val(), rarity:$("#rarity").val() },
                    success: function(data,status) {
                        if(!data){
                            alert("NO CARDS!");
                        }
                        else{
                            var cards = Object.values(data);
                            showCards(cards[0]);
                        }
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                    }
                  });//AJAX 
            }
            
            var count = 0;
            function showCards(cards){
                //console.log(cards.length);
                $("#cards").html("");
                for(var i = 0; i < cards.length; i++){
                    if(!(cards[i]['imageUrl'] == "undefined" || cards[i]['imageUrl'] == null))
                    {
                        //var imgHTML = "<img src='" + cards[i]['imageUrl'] + "' width='200' id='card" + i + "'>";
                        //var imgHTML = "<input type='image' src='" + cards[i]['imageUrl'] + "' width='200' id='card" + i + "' onclick='addCard('card" + i +  "')'>";
                        var imgHTML = "<button id='cardButton" + i + "'><img src='" + cards[i]['imageUrl'] + "' width='200' id='card" + i + "' onclick='addCard(\"#card" + i +  "\", " + cards[i]['multiverseid'] + ", \"" + cards[i]['imageUrl'] + "\")'></button>";
                        $("#cards").append(imgHTML);
                        count++;
                    }
                    
                    //console.log(imgHTML);
                }
                var countSpan = "<br><span>Number of cards on this page: " + count + "</span>";
                $("#cards").append(countSpan);
                var addButton = "<br><button onclick='nextPage()'>Next Page</button>";
                $("#cards").append(addButton);
                var deckButton = "<br><button onclick='addCards()'>Add Cards</button>";
                $("#cards").append(deckButton);
            }
            
            var cards = {
            };
            
            function addCard(card, cardID, imageURL){
                $(card).css("opacity", "0.5");
                
                if(cards[cardID] && cards[cardID].count < 4){
                    cards[cardID].count++;
                }
                else{
                    console.log("does not exist");
                     cards[cardID] = {
                        img: imageURL, 
                        count: 1
                    };
                    console.log("card created");
                }
                
                console.log(cards);
                  
            }
            
            function addCards(){
                $.ajax({
                    type: "post",
                    url: "addToDB.php",
                    dataType: "html",
                    data: { cards: cards },
                    success: function(data,status) {
                        $("#cards").html(data);
                        getDecks();
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
            }
            
            function getDecks(){
                $.ajax({
                    type: "get",
                    url: "getDecks.php",
                    dataType: "html",
                    data: {  },
                    success: function(data,status) {
                        $("#deck").html(data);
                        
                    },
                    complete: function(data,status) { //optional, used for debugging purposes

                    }
                  });//AJAX 
            }
            
            function addCardsToDeck(){
                
                var deckId = $("#selectDecks").val();
                
                cards
                $.ajax({
                    type: "post",
                    url: "addCardsToDeck.php",
                    dataType: "html",
                    data: { cards: cards, deckId: deckId },
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
                <li><a href="login.php" id="loggedout">Login</a></li>
                <li><a href="logout.php" id="loggedin">Logout</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
            <fieldset>
                <legend>FIND SOME CARDS!</legend>
                Choose the color(s):
                <input type="checkbox" id="colors" name="colors" value="black" class="checkbox" style="display:inline;vertical-align:middle;"><img src="img/black.png" width=20 class="colors">
                <input type="checkbox" id="colors" name="colors" value="blue" class="checkbox" style="display:inline;vertical-align:middle;"><img src="img/blue.png" width=20 class="colors">
                <input type="checkbox" id="colors" name="colors" value="green" class="checkbox" style="display:inline;vertical-align:middle;"><img src="img/green.png" width=20 class="colors">
                <input type="checkbox" id="colors" name="colors" value="red" class="checkbox" style="display:inline;vertical-align:middle;"><img src="img/red.png" width=20 class="colors">
                <input type="checkbox" id="colors" name="colors" value="white" class="checkbox" style="display:inline;vertical-align:middle;"><img src="img/white.png" width=20 class="colors"><br><br>
                
                Choose the type:
                <select id="type">
                    <option value="Artifact">Artifact</option>
                	<option value="Creature">Creature</option>
                	<option value="Enchantment">Enchantment</option>
                	<option value="Instant">Instant</option>
                	<option value="Legendary">Legendary</option>
                	<option value="Planeswalker">Planeswalker</option>
                	<option value="Sorcery">Sorcery</option>
                </select><br><br>
                
                Choose the rarity:
                <select id="rarity">
                    <option value="Common">Common</option>
                	<option value="Uncommon">Uncommon</option>
                	<option value="Rare">Rare</option>
                	<option value="Mythic Rare">Mythic Rare</option>
                </select><br><br>
                
                
                
                <button onclick="getCards(0)">Find cards!</button>
                
            </fieldset><br>
            
            <div id="cards">
            </div>
            <div id="deck">
            </div>
            
    </body>
</html>