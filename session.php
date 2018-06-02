<?php
    if (count(get_included_files()) == 1) die('Ingen tilgang!');
    session_start();
    $login = false;
    $login_session = "ikke logget inn";
    $forbindelse = db_connect();
    if (isset($_SESSION['login_user'])) {
        $user = $_SESSION['login_user'];
        $ses_sql = mysqli_query($forbindelse, "SELECT fornavn FROM kunde WHERE brukernavn = '{$user}'");
        $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
        $login_session = $row['fornavn'];
        if (strlen($login_session) > 30) {
            $login_session = substr($login_session, 0, 27) . "...";
        }
        $login = true;
        mysqli_free_result($ses_sql);
    }
?>