<!--We beginnen met PHP te openen.-->
<?php


/*We ontvangen de gebruikersnaam en wachtwoord als post.
  We zullen ze eerst als statement onthouden zodat we ze gemakkelijk later kunnen gebruiken.*/
if (isset($_POST['login-submit'])){
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $wachtwoord = $_POST['pws'];


    /*De volgende code stelt veel als/anders/of vragen.
    Dit is om te checken of de gebruikersnaam/email en het wachtwoord overeen komen met die uit de database.
    Deze zullen allemaal duidelijk worden in de links.
    Mocht u een veld vergeten zijn, het verkeerde wachtwoord invullen of de database runt niet.*/
    if (empty($mailuid) || empty($wachtwoord)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $resultaat = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($resultaat)) {
                $wwCheck = password_verify($wachtwoord, $row['pwsUsers']);
                if ($wwCheck == false) {
                    header("Location: ../index.php?error=verkeerdepws");
                    exit();
                }


                /*Als alles dan toch klopt moet je natuurlijk wel in de homepagina komen van jouw database.
                Hij start eerst een sessie om vervolgens jouw id, de id door computer gegenereerd en de email naast elkaar te zetten zodat je niet in
                een random homepagina komt van iemand anders. */
                else if ($wwCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    $_SESSION['email'] = $row['emailUsers'];

                    header("Location: ../index.php?login=success");
                    exit();

                }
                else {
                    header("Location: ../index.php?error=wrongpwsuid");
                    exit();
                }
            }


        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else {
    header("Location: ../signup.php");
    exit();
}