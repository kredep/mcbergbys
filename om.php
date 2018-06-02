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
    <title>Om Mcbergbys</title>
</head>
<body>
    <?php build_nav($login, $login_session, "om.php"); ?>
    <h1 class="centerText" id="om-title">Om McBergbys</h1>
    <div class="infoboks">
        <h3 class="centerText">Vi i McBergbys lover deg</h3>
        <ul>
            <li>Lynrask servering</li>
            <li>Helt greie priser</li>
            <li>Mat som smaker sånn passe</li>
        </ul>
    </div>
    <div class="kart">
        <h2 class="centerText">Her er vi</h2>
    <a href="https://kart.finn.no?lng=9.6691008878938&lat=59.138184195813&zoom=15&mapType=normap&WT.mc_id=hp_map_cb&title=Kart%20som%20viser%20McBergbys%20sin%20restaurant&showPin=true"><img id="finnkart" alt="Kart som viser hvor McBergbys sin restaurant ligger" title="Klikk for st&oslash;rre kart" src="https://kart.finn.no/map/image?lat=59.13818&lng=9.66910&mapType=&height=250&width=250&zoom=15&title=Kart+som+viser+McBergbys+sin+restaurant&showPin=on&key=4e5767534470911b17edeebc69754529"></a>
    </div>
    <p class="text">
    Det er ikke så mye interessant å skrive om McBergbys, les derfor heller dette utdraget fra en gratis bok om nevrale nettverk:<br><br> 
    The human visual system is one of the wonders of the world. Consider the following sequence of handwritten digits: (image of handwritten digits)<br><br>
    Most people effortlessly recognize those digits as 504192. That ease is deceptive. In each hemisphere of our brain, humans have a
     primary visual cortex, also known as V1, containing 140 million neurons, with tens of billions of connections between them. And 
     yet human vision involves not just V1, but an entire series of visual cortices - V2, V3, V4, and V5 - doing progressively more 
     complex image processing. We carry in our heads a supercomputer, tuned by evolution over hundreds of millions of years, and 
     superbly adapted to understand the visual world. Recognizing handwritten digits isn't easy. Rather, we humans are stupendously, 
     astoundingly good at making sense of what our eyes show us. But nearly all that work is done unconsciously. And so we don't usually 
     appreciate how tough a problem our visual systems solve.
    The difficulty of visual pattern recognition becomes apparent if you attempt to write a computer program to recognize digits like 
    those above. What seems easy when we do it ourselves suddenly becomes extremely difficult. Simple intuitions about how we recognize shapes
     - "a 9 has a loop at the top, and a vertical stroke in the bottom right" - turn out to be not so simple to express algorithmically. When you
      try to make such rules precise, you quickly get lost in a morass of exceptions and caveats and special cases. It seems hopeless.<br><br>
    Neural networks approach the problem in a different way. The idea is to take a large number of handwritten digits, known as training examples,
    and then develop a system which can learn from those training examples. In other words, the neural network uses the examples to automatically 
    infer rules for recognizing handwritten digits. Furthermore, by increasing the number of training examples, the network can learn more about 
    handwriting, and so improve its accuracy. So while I've shown just 100 training digits above, perhaps we could build a better handwriting 
    recognizer by using thousands or even millions or billions of training examples.<br><br>
    Michael A. Nielsen, "Neural Networks and Deep Learning", Determination Press, 2015.<br>Lisens: Creative Commons Attribution-NonCommercial 3.0 Unported Licence.
    </p>
    <?php if ($login==true) { echo('<script src="scripts/accessability.js"></script>'); } ?>
</body>
</html>