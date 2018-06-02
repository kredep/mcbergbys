<?php
require 'phpfunksjoner.php';
require 'session.php';

$db_forbindelse = db_connect();

$status = 0;

if (count($_POST) >= 6 && count($_POST) <= 7 && !isset($_SESSION['login_user'])) {

    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];
    $mypassword_repeat = $_POST['password-repeat'];
    $myfirstname = $_POST['firstname'];
    $mysurname = $_POST['surname'];
    $tlf = str_replace(" ","", $_POST['tlf']);

    $kriterier = array();
    if (!ctype_alnum($myusername)) { $kriterier[] = 'Brukernavnet kan kun inneholde bokstaver og tall'; }
    if (strlen($myusername) < 4 || strlen($myusername) > 45) { $kriterier[] = 'Brukernavnet må være mellom 4 og 45 tegn'; }
    if (strpos($mypassword, ' ') == true) { $kriterier[] = 'Passordet kan ikke ha mellomrom'; }
    if (strlen($mypassword) < 4) { $kriterier[] = "Passordet må ha mist fire tegn"; }
    if ($mypassword != $mypassword_repeat) { $kriterier[] = 'Passordene må være like'; }
    if (!preg_match('/^[a-z0-9 æøåö]+$/i', $myfirstname)) { $kriterier[] = 'Fornavnet ditt kan kun inneholde bokstaver og mellomrom'; }
    if (strlen($myfirstname) == 0) { $kriterier[] = "Vennligst fyll ut ditt fornavn"; }
    if (!ctype_alpha(str_replace(' ', '',$mysurname))) { $kriterier[] = 'Etternavnet ditt kan kun inneholde bokstaver og mellomrom'; }
    if (strlen($mysurname) == 0) { $kriterier[] = "Vennligst fyll ut ditt etternavn"; }
    if (!is_numeric($tlf)) { $kriterier[] = 'Telefonnummeret kan kun inneholde tall'; }
    if (strlen((string)$tlf) != 8) { $kriterier[] = 'Telefonnummeret skal ha 8 siffer'; }
    if (!isset($_POST['personvern'])) { $kriterier[] = 'Vennligst samtykk til vår personvernerklæring for å registere en konto'; }

    if (count($kriterier) != 0) {
        $status = 3;
    } else {
        $SQL = 'SELECT brukernavn FROM kunde WHERE brukernavn = "' . $myusername . '";';
        $result = mysqli_query($db_forbindelse, $SQL);
    
        if (mysqli_num_rows($result) == 0) {
            $SQL = "INSERT INTO kunde (brukernavn, passord, fornavn, etternavn, tlf) VALUES ('{$myusername}', '{$mypassword}', '{$myfirstname}', '{$mysurname}', {$tlf})";
            mysqli_query($db_forbindelse, $SQL);
            $_SESSION['login_user'] = $myusername;
            $status = 1;
        } else {
            $status = 2;
        }
    }
} else if (isset($_SESSION['login_user'])) {
    header("Location: index.php");
} else if (count($_POST == 0)) {
    $status = 0;
} else if (count($_POST) < 7) {
    $status = 4;
} else {
    $status = 5;
}
?>
<!DOCTYPE html>
<html lang="nb">
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
    <title>Ny konto</title>
</head>
<body>
    <?php
    switch($status) {
        case 0:
            build_nav(false, 'user', 'register.php');
            echo('<div class="register">');
                echo('<h1 id="login-title">Ny konto</h1>');
                echo('<form action="register.php" method="post">');
                    echo('<div class="input regin">');
                        echo('<label for="username"><span class="glyphicon glyphicon-user icon"></span></label>');
                        echo('<input class="user-input" type="text" name="username" id="username" placeholder="Brukernavn" autocomplete="off" spellcheck="false" required>');
                    echo('</div>');
                    echo('<div class="input login-space regin">');
                        echo('<label for="password"><span class="glyphicon glyphicon-lock icon"></span></label>');
                        echo('<input class="user-input" type="password" name="password" id="password" placeholder="Passord" autocomplete="off" spellcheck="false" required>');
                    echo('</div>');
                    echo('<div class="input login-space regin">');
                        echo('<label for="password-repeat"><span class="glyphicon glyphicon-repeat icon"></span></label>');
                        echo('<input class="user-input" type="password" name="password-repeat" id="password-repeat" placeholder="Gjenta passord" autocomplete="off" spellcheck="false" required>');
                    echo('</div>');
                    echo('<div class="input login-space regin">');
                        echo('<label for="firstname"><span class="glyphicon glyphicon-user icon"></span></label>');
                        echo('<input class="user-input" type="text" name="firstname" id="firstname" placeholder="Fornavn" autocomplete="off" spellcheck="false" required>');
                    echo('</div>');
                    echo('<div class="input login-space regin">');
                        echo('<label for="surname"><span class="glyphicon glyphicon-user icon"></span></label>');
                        echo('<input class="user-input" type="text" name="surname" id="surname" placeholder="Etternavn" autocomplete="off" spellcheck="false" required>');
                    echo('</div>');
                    echo('<div class="input login-space regin">');
                        echo('<label for="tlf"><span class="glyphicon glyphicon-earphone icon"></span></label>');
                        echo('<input class="user-input" type="text" name="tlf" id="tlf" placeholder="Telefonnummer" autocomplete="off" spellcheck="false" required>');
                    echo('</div>');
                    echo('<div>');
                        echo('<p id="info-personvern" class="centerText"><span id="info-personvern-icon" class="glyphicon glyphicon-info-sign"></span> <a class="draw meet" href="personvern.php"><u>Personvernerklæring</u></a></p>');
                    echo('</div>');
                    echo('<div>');
                        echo('<label for="personvern" class="check-container" id="bekreft-personvern">Jeg samtykker til McBergbys sin Personvernerklæring<input name="personvern" id="personvern" type="checkbox"><span class="checkmark"></span></label>');
                    echo('</div>');
                    echo('<input class="input login-space regin submit" type="submit" value="Opprett">');
                echo('</form>');
            echo('</div>');
            break;
        case 1:
            // welcome
            header('refresh:1.5;url=index.php');
            build_nav(false, 'user', 'register.php');
            echo('<h1 id="login-title" class="msg-fade">Bruker opprettet</h1>');
            break;
        case 2:
            header('refresh:5;url=register.php');
            build_nav(false, 'user', 'register.php');
            echo('<h1 id="login-title" class="msg-fade">Brukernavnet er opptatt</h1>');
            break;
        case 3:
            build_nav(false, 'user', 'register.php');
            echo('<h1 id="login-title" class="msg-fade">Vennligst oppfyll kriteriene under</h1>');
            echo('<div id="kriterier">');
                    foreach ($kriterier as $k) {
                        echo ('<p>' . $k . '</p>');
                    }
            echo('</div>');
            break;
        case 4:
            header('refresh:5;url=register.php');
            build_nav(false, 'user', 'register.php');
            echo('<h1 id="login-title" class="msg-fade">Vennligst fyll ut hele skjemaet</h1>');
            break;
        case 5:
            header('refresh:5;url=register.php');
            build_nav(false, 'user', 'register.php');
            echo('<h1 id="login-title" class="msg-fade">Oops! Det skjedde en feil!</h1>');
            break;
    }
    if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); }
    ?>
</body>
</html>
<?php db_close($db_forbindelse); ?>