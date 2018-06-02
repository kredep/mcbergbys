<?php
    require 'phpfunksjoner.php';
    require 'session.php';
    $status = 0;
    if ($login == true) {
            if (count($_POST) > 0) {
                $status = 1; // Alt ok
                $ordreid = lagre_ordre($forbindelse, $user, 99); // Totalprisen oppdateres senere
                $menu = array("drikke", "burger", "tilbehor", "ekstra");
                $sum = 0;
                $tabell = '<table id="oppsummering"><tr><th>Produkt</th><th>Kvantitet</th><th>Pris</th></tr>';
                foreach ($menu as $item) {
                    if (isset($_POST[$item])) {
                        if (is_array($_POST[$item])) {
                            foreach ($_POST[$item] as $t) {
                                $detlj = lagre_ordredetaljer($forbindelse, $user, $ordreid, $t);
                                $sum += $detlj[0];
                                $tabell .= $detlj[1];
                            }
                        }
                    }
                }
                $sum = number_format($sum, 2);
                $tabell .= "<tr><th>Sum</td><th></th><th>{$sum},-</th></tr></table>";
                $sql = "UPDATE ordre SET totalpris = {$sum} WHERE id = {$ordreid}";
                $resultat = mysqli_query($forbindelse, $sql);
                if (!$resultat) die('Kunne ikke oppdatere totalprisen: ' . mysqli_error($forbindelse));
            } else {
                $status = 2; // Kom ikke til siden gjennom skjemaet
            }
    } else {
        $status = 3; // Ikke logget inn
    }
    db_close($forbindelse);
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
    <title>Bestillingsmottak</title>
</head>
<body>
    <?php
    build_nav($login, $login_session, 'index.php');
    switch($status) {
        case 1:
            echo('<div class="skjema">');
                echo('<h1 class="skjema-title">Takk for din bestilling, ' . $login_session . '</h1>');
                echo('<h2 class="centerText">Ordrenummer: ' . $ordreid . '</h2>');
                echo('<h3 class="centerText">Hold deg oppdatert på bestillingen din ved å gå til "Mine Ordrer" under ditt navn på navigasjonsmenyen</h3>');
                echo('<h4 class="centerText"><span class="glyphicon glyphicon-user glyphicon-font-align"></span> '.$login_session.' <span class="glyphicon glyphicon-arrow-right glyphicon-font-align"></span> Mine ordrer</h4><br><br>');
                echo($tabell);
            echo('</div>');
            break;
        case 2:
            echo ('<h2 class="centerText">Denne siden kan kun benyttes gjennom Menyvelgeren</h2>');
            break;
        case 3:
            echo ('<h2 class="centerText">Vennligst logg inn for å kunne benytte denne siden gjennom menyvelgeren</h2>');
            break;
    }
    if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); }
    ?>
</body>
</html>