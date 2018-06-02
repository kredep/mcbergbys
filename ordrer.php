<?php
    require 'phpfunksjoner.php';
    require 'session.php';
    if ($login == false) {
        header('Location: login.php');
    }
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
    <title>Mine Ordrer</title>
</head>
<body>
    <?php build_nav($login, $login_session, 'ordrer.php');
        echo('<div class="login">');
        echo('<h1 id="login-title">Mine ordrer</h1>');
            echo('<form action="ordreliste.php" method="get">');
                echo('<h2 class="centerText">Hent ordrer med ordrestatus</h2>');
                echo('<div class="input">');
                    echo('<label for="ordrestatus"><span class="glyphicon glyphicon-tags icon"></span></label>');
                    echo('<select class="user-input" name="ordrestatus">');
                        echo('<option value="">Alle</option>');
                        echo('<option value="bestilt">Bestilt</option>');
                        echo('<option value="utføres">Utføres</option>');
                        echo('<option value="ferdig">Ferdig</option>');
                        echo('<option value="utlevert">Utlevert</option>');
                    echo('</select>');
                echo('</div>');
                echo('<input class="input login-space submit" type="submit" value="Hent ordrer">');
            echo('</form>');
            echo('<form id="ordlj" action="ordredetaljer.php" method="get">');
            echo('<h2 class="centerText">Hent ordredetaljer med ordreid</h2>');
            echo('<div class="input">');
                echo('<label for="ordreid"><span class="glyphicon glyphicon-tags icon"></span></label>');
                echo('<input class="user-input" type="number" name="ordreid" placeholder="Ordreid / Ordrenummer" autocomplete="off" spellcheck="false" required>');
            echo('</div>');
            echo('<input class="input login-space submit" type="submit" value="Hent ordredetaljer">');
        echo('</form>');
        echo('</div>');
    if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); } 
    ?>

</body>
</html>