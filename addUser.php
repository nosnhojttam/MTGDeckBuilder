<?php
    session_start();

    if (!isset($_SESSION['mtgUsername'])) {
        header('Location: login.php'); //sends users back to login screen if they haven't logged in
        exit;
    }
    if($_SESSION['mtgAdmin'] == 0){
        header('Location: index.php');
        exit;
    }
    

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Add User</title>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        
        <script>
            
            /*
        
          function checkUsername(){
              var isValid = true;
              if ($("#username").val().trim().length < 6) {
                  $("#usernameError").html("Username must be at least 6 characters!");
                  $("#usernameOk").html("");
                  isValid = false;
              } else{
              
              */
                
                /*
                  $.ajax({
                      type: "get",
                      url: "verifyUsername.php",
                      dataType: "json",
                      data: { "username": $("#username").val() },
                      success: function(data,status) {
                          //alert(data);  
                          if (!data){
                              $("#usernameError").html("");
                              $("#usernameOk").html("Username is available!");
                              $("#username").css("background-color", "#44FF44");
                          } else{
                              $("#usernameError").html("Username is unavailable!");
                              $("#usernameOk").html("");
                              isValid = false;
                          }
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                        }
                    });//AJAX    
                    
                  */
             // }
             // return isValid;
          //}
          
          
          /*
          function checkPassword(){
              if ($("#password1").val().trim().length < 7) {
                  $("#password1Error").html("Password must be at least 6 characters!");
                  isValid = false;
              }
              if(/(?=.*[A-Z])(?=.*\d)/.test($("#password1").val()) == false){
                  $("#password1Error").html("Password must have at least 1 uppercase letter and one digit");
                  isValid = false;
              }
          }
          
          function checkPasswordValidation(){
              if ($("#password2").val() != $("#password1").val()) {
                  $("#password2Error").html("Passwords must match!");
                  isValid = false;
              }
          }
          
          $(document).ready( function(){ 

             $("#username").change( function(){  
                 checkUsername();
             } );//username changes
             
                    
            $("#password1").change( function(){  
                 checkPassword();
             } );//pw1 changes
             
             $("#password2").change( function(){  
                 checkPasswordValidation();
             } );//pw2 changes
             
          });
          
          */
          
          
         
        
        </script>
        
        <style>
          .error {
             color: red;
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
                <li><a href="logout.php" id="loggedin">Logout</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
        <br><br>
        
        <form method="post" action="addUserToDB.php">
            <fieldset>
                <legend>Add, Edit, or Remove User</legend>
                    <table style="margin: 0 auto">
                        <tr>
                            <td>Username: <input type="text" id="username" name="username"><span id="usernameError" class="error"><span id="usernameOk"></span></td>
                            <td><span>Admin:</span> 
                                <select id="admin">
                                    <option value="y">Yes</option>
                                    <option value="n">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Password: <input type="password" id="password1" name="password1"><span id="password1Error" class="error"></span><span id="password1Ok"></span></td>
                            <td>Repeat Password: <input type="password" id="password2" name="password2"> <span id="password2Error" class="error"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" id="submitButton" value="Submit" name="submit"></td>
                        </tr>
        </table>
            </fieldset>
        </form>
        
        <form method="post" action="removeUser.php">
            <table style="margin: 0 auto">
                <tr>
                    <td>Username: <input type="text" id="username" name="username"></span></td>
                </tr>
            <tr>
                <td><input type="submit" id="remove" name="remove" value="Remove User"</td>
            </tr>
            </table>

        </form>
        
       
        
        
        <div id="update">
            
        </div>
        
        
    </body>
</html>