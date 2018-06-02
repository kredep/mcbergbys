<?php
    require 'phpfunksjoner.php';
    require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css" href="stiler/bootstrap-iso.css"> <!-- modifisert versjon av bootstrap (lagret lokalt) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="fonts/glyphicons-halflings-regular.eot"> <!-- Små ikoner -->
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css" href="stiler/style.css">
    <title>McBergbys Hamburgerskole</title>
</head>
<body>
    <?php build_nav($login, $login_session, "hamburgerskolen.php"); ?>
    <h1 class="centerText"> <span id="mcbergbys-tittel-skole">McBergbys</span> <br> <span id="skole-tittel">Hamburgerskole</span></h1>
        <div class="video">
            <h2 class="video-tittel">Lær deg å spise en hamburger</h2>
            <video id="video-local" controls>
                <source src="video/hvordan-spise-en-hamburger.mp4">
                Din nettleser støtter ikke video-taggen.
            </video>
            <div class="kilde">
                <p>Kilde: Studio Anka</p>
                <p>Lisens: Creative Commons BY</p>
            </div>
        </div>
        
        <div class="video">
            <h2 class="video-tittel">Lær deg å bestille en hamburger på engelsk</h2>
            <iframe id="video-youtube" src="https://www.youtube-nocookie.com/embed/lz0IT4Uk2xQ" allowfullscreen></iframe>
            <div class="kilde">
                <p>Kilde: YouTube / Pink Panther - <em>"I would like to buy a Hamburger"</em></p>
                <p>Lisens: Standard YouTube Lisens</p>
            </div>
        </div>
        <?php if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); } ?>
</body>
</html>