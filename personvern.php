<?php
    require 'phpfunksjoner.php';
    require 'session.php';
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
    <title>Personvern</title>
</head>
<body>
    <?php build_nav($login, $login_session, "personvern.php"); ?>
    <div class="personvern">
        <h1 id="personvern-tittel">Personvernerklæring<br>for McBergbys</h1>
        <div id="samtykk">
            <p>Denne personvernerklæringen forklarer hvordan McBergbys samler inn og bruker personopplysninger</p>
        </div>
        <ol id="erkl-liste">
            <li>Hvem er behandlingsansvarlig for personopplysningene?
                <p>Hos McBergbys er det den juridiske avdelingen som er behandlingsansvarlig for personopplysninger hentet via våre nettsider.</p>
            </li>
            <li>Hva er formålet med personopplysningene vi samler inn?
                <p>Hos McBergbys benyttes personopplysningene til å knytte din bestilling til din konto. På denne måten vet vi hvem du er og hva du har bestilt. Dermed kan du enkelt hente din bestilling.</p>
            </li>
            <li>Hva er det rettslige grunnlaget?
                <p>McBergbys hjemmel for behandling av personopplysninger er å kunne drifte og administrere virksomheten for å levere våre produkter til kunden ved hjelp av våre nettsider.</p>
            </li>
            <li>Hvilke personopplysninger behandles?
                <p>Opplysningene vi behandler omfatter:</p>
                <ul class="liste">
                    <li><p>Ditt navn</p></li>
                    <li><p>Ditt telefonnummer</p></li>
                    <li><p>Din bestilling av mat</p></li>
                </ul>
            </li>
            <li>Hvor hentes opplysningene fra?
                <p>Opplysningene hentes fra vårt bestillingsskjema når du registrerer en bestilling og når du registrerer en ny konto hos McBergbys.</p>
            </li>
            <li>Er det frivillig å gi fra seg opplysningene?
                <p>Ved bestilling hos McBergbys er det et krav å oppgi personopplysninger.</p>
            </li>
            <li>Utleveres opplysningene til tredjeparter?
                <p>Nei, McBergbys utleverer ikke opplysninger til tredjeparter.</p>
            </li>
            <li>Hvordan slettes og arkiveres opplysningene?
                <p>Av sikkerhetsgrunner og til kundens fordel, velger McBergbys å arkivere opplysninger om bestillinger i vårt system. Dette gjør at kunden kan logge inn og så tidligere bestillinger lagret i vårt system.</p>
            </li>
            <li>Hvilke rettigheter har den registrerte og hvilket lands lover gjelder?
                <p>Hos McBergbys gjelder Norges lovverk og den registrerte har rettighetene som følger det norske lovverket for personvern. Dette innebærer at den registrerte har rett til innsyn, retting, sletting og trekk av samtykk ved lagring av personopplysninger som følge av Personopplysningsloven § 18.</p>
            </li>
            <li>Hvordan sikres opplysningene?
                <p>Opplysningene vi samler inn sendes og lagres sikkert og lokalt i vår database til bestillingen er gjennomført.</p>
            </li>
            <li>Kontaktinformasjon
                <p>Dersom du har spørsmål eller trenger hjelp kan du nå oss på:</p>
                <ul class="liste">
                    <li><p><span class="glyphicon glyphicon-envelope"></span> <a class="draw meet kontakt" href="mailto:support@mcbergbys.no" target="_top">support@mcbergbys.no</a></p></li>
                    <li><p><span class="glyphicon glyphicon-earphone"></span> <span class="kontakt"> <strong>+47 12345678</strong></span></p></li>
                </ul>
            </li>
        </ol>
    </div>
    <?php if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); } ?>
</body>
</html>