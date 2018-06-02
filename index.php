<?php
    require 'phpfunksjoner.php';
    require 'session.php';
    $sql = "SELECT produktnavn, pris FROM produkt";
    $resultat = mysqli_query($forbindelse, $sql);
    $priser = array();
    if (mysqli_num_rows($resultat) > 0) {
        while ($row = mysqli_fetch_assoc($resultat)) {
            $priser[$row['produktnavn']] = $row['pris'];
        }
    }
    db_close($forbindelse);
?>
<!DOCTYPE html>
<html lang="nb">
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
    <title>Bestill</title>
</head>
<body>
    <?php build_nav($login, $login_session, 'index.php'); 
    if ($login == false) {
        echo('<div class="skjema">');
            echo('<h1 class="skjema-title">Velkommen, Gjest</h1>');
            echo('<h2 class="centerText">Vennligst opprett en konto eller logg inn for å plassere en bestilling</h2>');
            echo('<img class="plakat" src="bilder/plakat-mini.jpg" alt="Promoteringsplakat for McBergbys">');
            echo('<div id="nologinbuttons">');                          
                echo('<a class="input login-space submit nosignin-buttons" href="login.php">Logg inn</a>');
                echo('<a class="input login-space submit nosignin-buttons" href="register.php">Ny konto</a>');
            echo('</div>');
        echo('</div>');
    } else {
        echo('<div id="progressbar"></div>');
        echo('<div id="step-1" class="skjema">');
            echo('<h1 class="skjema-title">Menyvelgeren</h1>');
            echo('<img class="plakat" src="bilder/plakat-mini.jpg" alt="Promoteringsplakat for McBergbys">');
            echo ('<button type="button" id="skjema-start" class="input login-space submit skjema-submit" onclick="skjema_neste()" style="margin:0;">Start Menyvelgeren</button>');
        echo('</div>');
        echo('<form id="bestilling" action="bestillingsmottak.php" method="post">');
        echo('<div class="skjema step">');
            echo('<h1 class="skjema-title">Drikke</h1>');
            echo('<h1 class="skjema-msg">Velg drikke fra vår menyvelger</h1>');
            echo('<div>');
                echo('<label for="cola" class="check-container">Cola<input name="drikke[]" value="Cola" id="cola" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(1,0, ' . $priser['cola'] .')">-</button><input name="kvant[]" id="1" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(1,1, ' . $priser['cola'] .')">+</button></div><p id="1-p" class="priser">' . $priser['cola'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="solo" class="check-container">Solo<input name="drikke[]" value="Solo" id="solo" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(2,0,' . $priser['solo'] . ')">-</button><input name="kvant[]" id="2" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(2,1, ' . $priser['solo'] .')">+</button></div><p id="2-p" class="priser">' . $priser['solo'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="sitronbrus" class="check-container">Sitronbrus<input name="drikke[]" value="Sitronbrus" id="sitronbrus" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(3,0,' . $priser['sitronbrus'] . ')">-</button><input name="kvant[]" id="3" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(3,1, ' . $priser['sitronbrus'] .')">+</button></div><p id="3-p" class="priser">' . $priser['sitronbrus'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="vann" class="check-container">Vann<input name="drikke[]" value="Vann" id="vann" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(4,0,' . $priser['vann'] . ')">-</button><input name="kvant[]" id="4" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(4,1, ' . $priser['vann'] .')">+</button></div><p id="4-p" class="priser">' . $priser['vann'] . ',-</p>');
            echo('</div>');
        echo('</div>');
        echo('<div class="skjema step">');
            echo('<h1 class="skjema-title">Burger</h1>');
            echo('<h1 class="skjema-msg">Velg en burger fra vår menyvelger</h1>');
            echo('<div>');
                echo('<label for="superburger" class="check-container">Superburger<input name="burger[]" value="Superburger" id="superburger" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(5,0, ' . $priser['superburger'] .')">-</button><input name="kvant[]" id="5" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(5,1, ' . $priser['superburger'] .')">+</button></div><p id="5-p" class="priser">' . $priser['superburger'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="cheeseburger" class="check-container">Cheeseburger<input name="burger[]" value="Cheeseburger" id="cheeseburger" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(6,0,' . $priser['cheeseburger'] . ')">-</button><input name="kvant[]" id="6" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(6,1, ' . $priser['cheeseburger'] .')">+</button></div><p id="6-p" class="priser">' . $priser['cheeseburger'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="veggisburger" class="check-container">Veggisburger<input name="burger[]" value="Veggisburger" id="veggisburger" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(7,0,' . $priser['veggisburger'] . ')">-</button><input name="kvant[]" id="7" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(7,1, ' . $priser['veggisburger'] .')">+</button></div><p id="7-p" class="priser">' . $priser['veggisburger'] . ',-</p>');
            echo('</div>');
        echo('</div>');
        echo('<div class="skjema step">');
            echo('<h1 class="skjema-title">Tilbehør</h1>');
            echo('<h1 class="skjema-msg">Velg blant godt tilbehør fra vår menyvelger</h1>');
            echo('<div>');
                echo('<label for="pommes-frites" class="check-container">Pommes frites<input name="tilbehor[]" value="Pommes-Frites" id="pommes-frites" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(8,0, ' . $priser['pommes-frites'] .')">-</button><input name="kvant[]" id="8" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(8,1, ' . $priser['pommes-frites'] .')">+</button></div><p id="8-p" class="priser">' . $priser['pommes-frites'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="lokringer" class="check-container">Løkringer<input name="tilbehor[]" value="Lokringer" id="lokringer" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(9,0,' . $priser['lokringer'] . ')">-</button><input name="kvant[]" id="9" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(9,1, ' . $priser['lokringer'] .')">+</button></div><p id="9-p" class="priser">' . $priser['lokringer'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="cheese-sticks" class="check-container">Cheese sticks<input name="tilbehor[]" value="Cheese-Sticks" id="cheese-sticks" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(10,0,' . $priser['cheese-sticks'] . ')">-</button><input name="kvant[]" id="10" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(10,1, ' . $priser['cheese-sticks'] .')">+</button></div><p id="10-p" class="priser">' . $priser['cheese-sticks'] . ',-</p>');
            echo('</div>');
        echo('</div>');
        echo('<div class="skjema step">');
            echo('<h1 class="skjema-title">Ekstra</h1>');
            echo('<h1 class="skjema-msg">Velg noe ekstra fra vår menyvelger</h1>');
            echo('<div>');
                echo('<label for="ketchup" class="check-container">Ketchup<input name="ekstra[]" value="Ketchup" id="ketchup" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(11,0, ' . $priser['ketchup'] .')">-</button><input name="kvant[]" id="11" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(11,1, ' . $priser['ketchup'] .')">+</button></div><p id="11-p" class="priser">' . $priser['ketchup'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="sennep" class="check-container">Sennep<input name="ekstra[]" value="Sennep" id="sennep" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(12,0,' . $priser['sennep'] . ')">-</button><input name="kvant[]" id="12" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(12,1, ' . $priser['sennep'] .')">+</button></div><p id="12-p" class="priser">' . $priser['sennep'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="grillkrydder" class="check-container">Grillkrydder<input name="ekstra[]" value="Grillkrydder" id="grillkrydder" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(13,0,' . $priser['grillkrydder'] . ')">-</button><input name="kvant[]" id="13" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(13,1, ' . $priser['grillkrydder'] .')">+</button></div><p id="13-p" class="priser">' . $priser['grillkrydder'] . ',-</p>');
            echo('</div>');
            echo('<div class="skjema-space">');
                echo('<label for="dip" class="check-container">Dip<input name="ekstra[]" value="Dip" id="dip" type="checkbox"><span class="checkmark"></span></label>');
                echo('<div class="btns"><button type="button" class="plu-min" onclick="adjust(14,0,' . $priser['dip'] . ')">-</button><input name="kvant[]" id="14" class="kvantitet" type="number" value="1"><button type="button" class="plu-min" onclick="adjust(14,1, ' . $priser['dip'] .')">+</button></div><p id="14-p" class="priser">' . $priser['dip'] . ',-</p>');
            echo('</div>');
        echo('</div>');
        echo('<div class="skjema step">');
            echo('<h1 class="skjema-title">Oppsummering</h1>');
            echo('<p id="oppsummering"></p>');
        echo('</div>');
        echo('</form>');
        echo ('<button type="button" id="skjema-forrige" class="input login-space submit" onclick="skjema_forrige()">Forrige</button>');
        echo ('<button type="button" id="skjema-send" class="input login-space submit" onclick="skjema_submit()">Send bestilling</button>');
        echo ('<button type="button" id="skjema-neste" class="input login-space submit" onclick="skjema_neste()">Neste</button>');
    }
    if ($login == true) {
        echo('<script src="scripts/bestilling.js"></script>');    
        echo('<script src="scripts/accessability.js"></script>');
    }
    ?>
</body>
</html>