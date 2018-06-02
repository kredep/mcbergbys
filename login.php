<?php
require 'phpfunksjoner.php';
require 'session.php';

$db_forbindelse = db_connect();

$status = 0;

if (count($_POST) > 0 && !isset($_SESSION['login_user'])) {

    $myusername = mysqli_real_escape_string($db_forbindelse, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db_forbindelse, $_POST['password']); 

    $SQL = 'SELECT fornavn FROM kunde WHERE brukernavn = "' . $myusername . '" AND passord = "' . $mypassword . '";';
    $result = mysqli_query($db_forbindelse, $SQL);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login_user'] = $myusername;
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $login_session = $row['fornavn'];
        $status = 1;
    } else {
        $status = 2;
    }
} else if (isset($_SESSION['login_user'])) {
    header("Location: index.php");
    $status = -1;
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
    <title>Logg inn</title>
</head>
<body>
    <?php
    if ($status == 0) {
        build_nav($login, $login_session, 'login.php');
        echo('<div class="login">');
        echo('<h1 id="login-title">Logg inn</h1>');
            echo('<form action="login.php" method="post">');
                echo('<div class="input regin">');
                    echo('<label for="username"><span class="glyphicon glyphicon-user icon"></span></label>');
                    echo('<input class="user-input" type="text" name="username" id="username" placeholder="Brukernavn" autocomplete="off" spellcheck="false" required>');
                echo('</div>');
                echo('<div class="input login-space regin">');
                    echo('<label for="password"><span class="glyphicon glyphicon-lock icon"></span></label>');
                    echo('<input class="user-input" type="password" name="password" id="password" placeholder="Passord" autocomplete="off" spellcheck="false" required>');
                echo('</div>');
                echo('<input class="input login-space regin submit" type="submit" value="Logg inn">');
            echo('</form>');
        echo('</div>');
    } else if ($status == 1) {
        // welcome
        header('refresh:1.5;url=index.php');
        build_nav(false, 'user', 'login.php');
        echo('<h1 id="login-title" class="msg-fade">Velkommen, '.$login_session.'</h1>');
    } else if ($status == 2) {
        header('refresh:5;url=login.php');
        build_nav(false, 'user', 'login.php');
        echo('<h1 id="login-title" class="msg-fade">Feil brukernavn og/eller passord</h1>');
    }
    if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); }
    ?>
</body>
</html>
<?php db_close($db_forbindelse); ?>