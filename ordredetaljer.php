<?php
    require 'phpfunksjoner.php';
    require 'session.php';
    $status = 0;
        if ($login == true) {
            if(isset($_GET['ordreid'])) {
                $ordreid = $_GET['ordreid'];
                if (is_numeric($ordreid)) {
                    $sql = "SELECT id FROM ordre WHERE kunde_brukernavn = '{$user}' AND id = {$ordreid}";
                    $resultat = mysqli_query($forbindelse, $sql);
                    if (mysqli_num_rows($resultat) == 1) {
                        $status = 2;
                        $ordredetaljer = hent_ordredetaljer($forbindelse, $ordreid);
                    } else {
                        $status = 1;
                    }
                } else {
                    $status = 5;
                }
            } else {
                $status = 3;
            }
        } else {
            $status = 4;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Peder T. Kristensen">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css" href="stiler/bootstrap-iso.css"> <!-- modifisert versjon av bootstrap (lagret lokalt) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="fonts/glyphicons-halflings-regular.eot"> <!-- Små ikoner -->
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css" href="stiler/style.css">
    <title>Ordredetaljer</title>
</head>
<body>
    <?php
    build_nav($login, $login_session, 'ordrer.php');
    switch ($status) {
        case 1:
            echo('<h2 class="centerText">Fant ingen ordre for brukernavn <u>'.$user.'</u> med ordrenummer <u>'.$ordreid.'</u></h2>');
            break;
        case 2:
            echo('<h2 class="centerText">Ordredetaljer for ordrenummer <u>'.$ordreid.'</u> funnet</h2>');
            echo(resultat_til_html_tabell($ordredetaljer, "resulttotable2"));
            break;
        case 3:
            echo('<h2 class="centerText">Ingen ordre id funnet i URL-en</h2>');
            break;
        case 4:
            echo('<h2 class="centerText">Vennligst logg inn for å bruke denne siden!</h2>');
            break;
        case 5:
            echo('<h2 class="centerText">Ordrenummeret skal kun inneholde tall!</h2>');
            break;
    }
    if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); }
    ?>
</body>
</html>
<?php
    db_close($forbindelse);
?>