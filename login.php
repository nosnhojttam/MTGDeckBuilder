<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        
        
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
              </ul>
              <form class="navbar-form navbar-left">
              </form>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
        
        <form method="post" action="processLogin.php">
            <fieldset>
                <legend>Login</legend>
                    <table style="margin: 0 auto">
                        <tr>
                            <td>Username: <input type="text" id="username" name="username"></td>
                            <td>Password: <input type="password" id="password" name="password"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" id="submitButton"></td>
                        </tr>
                    </table>
            </fieldset>
        </form>
        <h3>Hint: username: matjohnson password: s3cr3t</h3>
    </body>
</html>