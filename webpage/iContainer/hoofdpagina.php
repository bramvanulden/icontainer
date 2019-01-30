<!--Welkom bij de code, de volgende code is voor de inlogpagina.-->


<!--We beginnen met het openen de database door verwijzing naar de andere php.-->
<?php
session_start();
require "includes/dbh.inc.php";
?>


<!--Vervolgens openen we de front-end van de website. Hierin verwerken we een link naar de iconen die worden gebruikt.
    Daarnaast openen we de stylesheet die we gebruiken voor de site.-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>


<!--In de body wordt het middenstuk van de site geopend.-->
<body>


<!--We beginnen gelijk de body een class te geven zodat we dit later in de stylesheet kunnen terughalen.-->
<div class="login-box">
    <h1>Home</h1>


        <!--Vervolgens checken we of we ingelogd zijn of niet.
        Zo niet komt de inlogpagina naar boven en anders gaan we gelijk door naar de homepagina.
        De inlogpagina bestaat uit 2 boxen voor naam en wachtwoord met daaronder een login button of een registreer button.
        Je email/gebruikersnaam en wachtwoord worden gecheckt in het includes/login/inc.php bestand en wordt verzonden als post.
        Ben je wel ingelogd krijg je alleen een logout button te zien en geen login/registreer button.-->
        <?php
        if (!isset($_SESSION['userId'])) {
            echo '<form action="includes/login.inc.php" method="post">
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="mailuid" placeholder="E-mail/Gebruikersnaam">
                </div>

            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pws" placeholder="Wachtwoord">
                </div>


            <button class="btn" type="submit" name="login-submit">Login</button>
            <a href="signup.php" class="btn">Registreren</a>
          </form>';

        }
        else if (isset($_SESSION['userId'])) {
            echo '<form action="iContainer/includes/logout.inc.php" method="post">
            <button class="btn" type="submit" name="login-submit">Logout</button>
          </form>';
        }
        ?>
    </div>


<!--Als laatste sluiten we alles.-->
</body>
</html>
