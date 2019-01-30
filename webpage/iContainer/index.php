<?php
    require "hoofdpagina.php";
?>

    <main>
        <div class="wrapper-main">
            <section class="section-default">
        <?php
        if (isset($_SESSION['userId'])){
            echo '<p>Your are logged in!</p>';
            header("Location: ../newhome.php");
            exit();
        }
        else{
            echo '<p>Your are logged out!</p>';
            header("Location: ../iContainer/hoofdpagina.php");
            exit();
        }
        ?>
            </section>
        </div>

    </main>