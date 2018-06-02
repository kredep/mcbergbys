<?php
if (count(get_included_files()) == 1) die('Ingen tilgang!');
function db_connect () {
    $db_host = 'localhost';
    $db_navn = '0209krpe';
    $db_bruker = '0209krpe';
    $db_pass = '0209';

    $db_forbindelse = @mysqli_connect($db_host, $db_bruker, $db_pass, $db_navn);

    if (mysqli_connect_errno()) 
    {
        die('Kunne ikke koble til databasen: ' . mysqli_error($forbindelse));
    } else {
        return $db_forbindelse;
    }
}

function db_close($connection) {
    mysqli_close($connection);
}

function build_nav($login, $login_session, $current) {
    echo('<nav class="navbar navbar-default navbar-static-top">');
        echo('<div class="container-fluid">');
            echo('<div class="navbar-header">');
                echo('<button id="nav-collapse" type="button" class="navbar-toggle draw-inverse meet-inverse" data-toggle="collapse" data-target="#mynav" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span></button>');
                echo('<a class="navbar-brand">McBergbys</a>');
            echo('</div>');
        echo('<div class="collapse navbar-collapse" id="mynav">');
    echo('<ul class="nav navbar-nav">');
        if ($current == 'index.php') {echo('<li><a id="current" class="draw meet" href="index.php" tabindex="1">Bestill</a></li>');} else {echo('<li><a class="draw meet" href="index.php" tabindex="1">Bestill</a></li>');}
        if ($current == 'hamburgerskolen.php') {echo('<li><a id="current" class="draw meet" href="hamburgerskolen.php" tabindex="2">Hamburgerskolen</a></li>');} else {echo('<li><a class="draw meet" href="hamburgerskolen.php" tabindex="2">Hamburgerskolen</a></li>');}
        if ($current == 'om.php') {echo('<li><a id="current" class="draw meet" href="om.php" tabindex="3" onfocus="hideSub()">Om McBergbys</a></li>');} else {echo('<li><a class="draw meet" href="om.php" tabindex="3" onfocus="hideSub()">Om McBergbys</a></li>');}
        echo('<li class="nav-divider"></li>');
    echo('</ul>');
    echo('<ul class="nav navbar-nav navbar-right">');
                if ($login == true) {
                    if ($current == 'ordrer.php') {echo ('<li tabindex="4" id="current" class="draw meet dropdown">');} else {echo ('<li class="draw meet dropdown" tabindex="4">');}
                        echo ('<div>');
                            echo ('<a class="dropbtn"><span class="glyphicon glyphicon-user glyphicon-font-align"></span> ' . $login_session . '</a>');
                            echo ('<div id="submenu" class="dropdown-content">');
                            if ($current == 'ordrer.php') {echo ('<a id="current" class="draw-inverse meet-inverse subbutton" style="color:white;" href="ordrer.php" tabindex="5">Mine ordrer</a>');} else {echo ('<a class="draw-inverse meet-inverse subbutton" href="ordrer.php" tabindex="5">Mine ordrer</a>');}
                            echo ('<a class="draw-inverse meet-inverse subbutton" href="logout.php" tabindex="7">Logg ut</a>');
                            echo ('</div>');
                        echo ('</div>');
                    echo ('</li>');
                    if ($current == 'personvern.php') {echo('<li><a id="current" class="draw meet" href="personvern.php" tabindex="8" onfocus="hideSub()">Personvern</a></li>');} else {echo('<li><a class="draw meet" href="personvern.php" tabindex="8" onfocus="hideSub()">Personvern</a></li>');}
                } else {
                    if ($current == 'login.php') {echo('<li><a id="current" class="draw meet" href="login.php" tabindex="4"><span class="glyphicon glyphicon-user glyphicon-font-align"></span> Logg inn</a></li>');} else {echo('<li><a class="draw meet" href="login.php" tabindex="4"><span class="glyphicon glyphicon-user glyphicon-font-align"></span> Logg inn</a></li>');}
                    if ($current == 'register.php') {echo('<li><a id="current" class="draw meet" href="register.php" tabindex="5">Ny konto</a></li>');} else {echo('<li><a class="draw meet" href="register.php" tabindex="5">Ny konto</a></li>');}
                    if ($current == 'personvern.php') {echo('<li><a id="current" class="draw meet" href="personvern.php" tabindex="6">Personvern</a></li>');} else {echo('<li><a class="draw meet" href="personvern.php" tabindex="6">Personvern</a></li>');}
                }
            echo('</ul>');
        echo('</div>');
    echo('</div>');
echo('</nav>');
}

function frigjor_data ($resultat) {
    return mysqli_free_result($resultat);
}

function lagre_ordre($forbindelse, $brukernavn, $totalpris) {
    $tidspunkt = hent_tid();
    $sql_ny_ordre = "INSERT INTO ordre (kunde_brukernavn, tidspunkt, totalpris, status)
                     VALUES ('{$brukernavn}','{$tidspunkt}','$totalpris','bestilt');";
    $resultat = mysqli_query($forbindelse, $sql_ny_ordre);
    if (!$resultat) die('Kunne ikke lagre ordren: ' . mysqli_error($forbindelse));
        return mysqli_insert_id($forbindelse);
}

function lagre_ordredetaljer ($forbindelse, $brukernavn, $ordreid, $produkt) {
    $sql_finn_produkt = "SELECT id, pris FROM produkt WHERE produktnavn = '{$produkt}'";
    $sql_ny_ordredetalj = "INSERT INTO ordredetalj (ordre_id, produkt_id, kvantitet, enhetspris) VALUES";
    
    $resultat = mysqli_query($forbindelse, $sql_finn_produkt);
    if (!$resultat) die('Oppslag av produktdetaljer feilet: ' . mysqli_error($forbindelse));
    $produktinfo = mysqli_fetch_assoc($resultat);
    mysqli_free_result($resultat);

    $kvantitet = $_POST['kvant'][$produktinfo['id']-1];
    
    $sql_reduser_beholdning = "UPDATE produkt SET beholdning = beholdning - '{$kvantitet}' WHERE produktnavn = '{$produkt}'";
    $resultat = mysqli_query($forbindelse, $sql_reduser_beholdning);
    if (!$resultat) die('Reduksjon av beholdning feilet: ' . mysqli_error($forbindelse));

    $sql_ny_ordredetalj .= "({$ordreid}, {$produktinfo['id']}, {$kvantitet}, {$produktinfo['pris']})";
    $resultat = mysqli_query($forbindelse, $sql_ny_ordredetalj);
    if (!$resultat) echo("Innlegging av ordredetaljer feilet - " . $produkt . ": " . mysqli_error($forbindelse));
    $pris = number_format($kvantitet * $produktinfo['pris'],2);
    $tabell = "<tr><td>{$produkt}</td><td>{$kvantitet}</td><td>{$pris},-</td></tr>";
    return [$pris, $tabell];
}

function hent_ordredetaljer($forbindelse, $ordreid) {
    $sql = "SELECT produkt.produktnavn, ordredetalj.kvantitet, ordredetalj.enhetspris
            FROM ordredetalj
            JOIN produkt ON produkt_id = produkt.id
            WHERE ordredetalj.ordre_id = {$ordreid}";
    return mysqli_query($forbindelse, $sql);
}

function hent_ordrer($db_forbindelse, $brukernavn, $status = NULL) {
  $spørring = "SELECT ordre.id, ordre.tidspunkt, ordre.totalpris, ordre.status
               FROM ordre
               JOIN kunde ON kunde_brukernavn = kunde.brukernavn WHERE kunde_brukernavn = '{$brukernavn}' ";
  if ($status) {
    $spørring .= " AND ordre.status = '{$status}'";
  }
  $spørring .= " ORDER BY ordre.tidspunkt DESC";
  return mysqli_query($db_forbindelse, $spørring);
}

function resultat_til_html_tabell($resultat, $cssklasse = "", $link = false) {
  $tabell = "<table class=\"{$cssklasse}\">\n";
  $tabell .= "<tr>\n";
  //Se https://secure.php.net/manual/en/mysqli-result.fetch-fields.php
  $kolonneinfo = mysqli_fetch_fields($resultat);
  foreach ($kolonneinfo as $k) {
    $tabell .= "\t<th>".ucfirst($k->name)."</th>\n";
  }
  $tabell .= "</tr>\n";
  while ($rad = mysqli_fetch_row($resultat)) {
    $tabell .= "<tr>\n";
    $first = true;
    foreach ($rad as $felt) {
        if ($first == true && $link == true) {
            $first = false;
            $tabell .= "\t<td>".'<u><a class="draw meet" href="ordredetaljer.php?ordreid='.$felt.'">'.$felt.'</a></u>'."</td>\n";
        } else {
            $tabell .= "\t<td>{$felt}</td>\n";
        }
    }
    $tabell .= "</tr>\n";
  }
  $tabell .= "</table>\n";
  return $tabell;
}

function hent_tid () {
    return date("Y-m-d H:i:s");
}
?>