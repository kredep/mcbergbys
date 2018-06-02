<?php
require 'phpfunksjoner.php';
require 'session.php';

$db_forbindelse = db_connect();

$status = 0;
if (isset($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db_forbindelse,'SELECT username FROM users WHERE username = "' . $user_check . '";');
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $login_session = $row['username'];
}

if (count($_POST) > 0 && !isset($_SESSION['login_user'])) {

    $myusername = mysqli_real_escape_string($db_forbindelse, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db_forbindelse, $_POST['password']); 

    $SQL = 'SELECT id FROM users WHERE username = "' . $myusername . '" AND password = "' . $mypassword . '";';
    $result = mysqli_query($db_forbindelse, $SQL);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login_user'] = $myusername;
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
    <link rel="stylesheet" type="text/css" href="stiler/style.css">
    <link rel="stylesheet" type="text/css" href="stiler/bootstrap-iso.css">
    <link rel="stylesheet" type="text/css" href="fonts/glyphicons-halflings-regular.eot">
    <title>Logg inn</title>
</head>
<body>
    <?php
    build_nav($login, $login_session);

    if ($status == 0)
    {
        echo('<h1 id="title">logg inn</h1>');
            echo('<div id="login">');
                    echo('<form id="login_form" method="post" action="login.php">');
                        echo('<div class="input">');
                            echo ('<label class="input-label" for="username">username</label>');
                            echo('<input required id="user" name="username" type="text" autocomplete="off" spellcheck="false" onkeypress="return event.keyCode != 13" onkeydown="setTimeout(KeyDownEvent(event), 10)">');
                        echo('</div>');
                        echo('<div class="input">');
                            echo ('<label class="input-label" for="password">password</label>');
                            echo('<input required id="pass" name="password" type="password" autocomplete="off" spellcheck="false" onkeypress="return event.keyCode != 13" onkeydown="setTimeout(KeyDownEvent(event), 10)">');
                        echo('</div>');
                    echo('</form>');
            echo('</div>');
    } else if ($status == 1) {
        //welcome
        echo('<h1 id="status">welcome</h1>');
        header( "refresh:2.5;url=index.php");
    } else if ($status == 2) {
        //failed
        echo('<h1 id="status">failed</h1>');
        header( "refresh:2.5;url=login.php");
    }
    ?>
    <script>
    </script>
</body>
</html>