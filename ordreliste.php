<?php
    require 'phpfunksjoner.php';
    require 'session.php';
    $status = 0;

    if (isset($_GET['ordrestatus'])) {
      $ordrestatus = $_GET['ordrestatus'];
    } else {
      $ordrestatus = null;
    }

    if ($login == true) {
        $ordrer = hent_ordrer($forbindelse, $user, $ordrestatus);
        if (mysqli_num_rows($ordrer) >= 1) {
            $status = 2;
        } else {
            if ($ordrestatus == NULL) {
                $status = 1;
            } else {
                $status = 0;
            }
        }
    } else {
        $status = 3;
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
    <title>Ordreliste</title>
</head>
<body>
    <?php
    build_nav($login, $login_session, 'ordrer.php');
    switch ($status) {
        case 0:
            echo('<h2 class="centerText">Fant ingen ordre plassert med brukernavn <u>'.$user.'</u> med ordrestatus <u>'.$ordrestatus.'</u></h2>');
            break;
        case 1:
            echo('<h2 class="centerText">Fant ingen ordre plassert med brukernavn <u>'.$user.'</u></h2>');
            break;
        case 2:
            if ($ordrestatus == null) {
              echo('<h2 class="centerText">Ordrer for bruker <u>'.$user.'</u> funnet</h2>');
            } else {
              echo ('<h2 class="centerText">Ordrer for bruker <u>'.$user.'</u> med ordrestatus <u>'.$ordrestatus.'</u> funnet</h2>');
            }
            echo('<h3 class="centerText">Trykk på en ordreid for å gå til ordredetaljene for bestillingen</h3><br><br>');
            echo(resultat_til_html_tabell($ordrer, "resulttotable1", true));
            break;
        case 3:
            echo('<h2 class="centerText">Vennligst logg inn for å bruke denne siden!</h2>');
            break;
    }
    if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); }
    ?>
</body>
</html>
<?php
    db_close($forbindelse);
?>