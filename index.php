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
        <title>336</title>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        
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
        
        <br><br>
        <h1>WELCOME TO THE ULTIMATE DECK BUILDER</h1>
        <h1>LOGIN TO CONTINUE</h1>
        <br><br>
        
        <h2>IF YOU DON'T HAVE A LOGIN, FEEL FREE TO BROWSE CARDS :^)</h2>
        <br><br>
        
        <a href="https://docs.google.com/a/csumb.edu/document/d/19L_ibLSVP9-V00wmf5-ZNROzNw5Wmv6GyRBeISbAB48/edit?usp=sharing" target="_blank">Click here to check out my documentation!</a>
    </body>
</html>