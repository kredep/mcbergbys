var progress = 0;
var finish = 4
var boxes = document.getElementsByClassName('skjema');
var progressbar = document.getElementById('progressbar');
var next_button = document.getElementById('skjema-neste');
var prev_button = document.getElementById('skjema-forrige');
var sub_button = document.getElementById('skjema-send');
var prod = ['cola','solo','sitronbrus','vann','superburger','cheeseburger','veggisburger','pommes-frites','lokringer', 'cheese-sticks','ketchup','sennep','grillkrydder','dip'];
progressbar.style.width = 0;
prev_button.style.opacity = 0;
next_button.style.opacity = 0;
next_button.style.display = "none";
prev_button.style.display = "none";
sub_button.style.opacity = 0;
sub_button.style.display = "none";
function skjema_neste() {
    if (progress == 0) {
        next_button.style.visibility = "visible";
        prev_button.style.visibility = "visible";
        prev_button.style.opacity = 1;
        next_button.style.opacity = 1;
        next_button.style.display = "inline";
        prev_button.style.display = "inline";
    } else if (progress == 4) {
        next_button.style.visibility = "hidden";
        next_button.style.opacity = 0;
        next_button.style.display = "none";
        sub_button.style.visibility = "visible";
        sub_button.style.opacity = 1;
        sub_button.style.display = "inline";
        lag_oppsummering();
    }
    boxes[progress].style.visibility = "hidden";
    boxes[progress].style.opacity = 0;
    boxes[progress+1].style.visibility = "visible";
    boxes[progress+1].style.opacity = 1;
    var w = document.body.clientWidth + 16;
    progressbar.style.width = ((progress+1)/(finish+1)) * w + "px";
    boxes[progress].style.display = "none";
    boxes[progress+1].style.display = "block";
    progress += 1;
}

function skjema_forrige() {
    if (progress == 1) {
        next_button.style.visibility = "hidden";
        prev_button.style.visibility = "hidden";
        prev_button.style.opacity = 0;
        next_button.style.opacity = 0;
        next_button.style.display = "none";
        prev_button.style.display = "none";
    } else if (progress == 5) {
        sub_button.style.visibility = "hidden";
        sub_button.style.opacity = 0;
        sub_button.style.display = "none";
        next_button.style.visibility = "visible";
        next_button.style.opacity = 1;
        next_button.style.display = "inline";
    }
    boxes[progress].style.visibility = "hidden";
    boxes[progress].style.display = "none";
    boxes[progress].style.opacity = 0;
    boxes[progress-1].style.visibility = "visible";
    boxes[progress-1].style.display = "block";
    boxes[progress-1].style.opacity = 1;
    var w = document.body.clientWidth + 16;
    progressbar.style.width = ((progress-1)/(5+1)) * w + "px";
    progress -= 1;
}

function lag_oppsummering() {
    var items = {};
    var sum = 0;
    var oppsum = "";
    var i;
    for (i = 0; i < prod.length; i++) {
        if (document.getElementById(prod[i]).checked) {
            items[prod[i]] = document.getElementById(i+1).value;
            sum += parseFloat(document.getElementById((i+1) + "-p").innerHTML);
        }
    }
    if (items.length == 0) {
        document.getElementById('oppsummering').innerHTML = "Du har ikke valgt noen produkter!";
    } else {
        for (var key in items) {
            oppsum += items[key] + "x " + key.charAt(0).toUpperCase() + key.slice(1) + "<br>";
        }
        oppsum += "<br><strong>Sum: " + sum.toFixed(2) + ",-</strong>";
        document.getElementById('oppsummering').innerHTML = oppsum;
    }
}

function skjema_submit() {
    var i;
    var status = 0;
    var status2 = 0;
    for (i=0;i<prod.length;i++) {
        if (document.getElementById(prod[i]).checked) {
            status += 1;
        }
        if (parseInt(document.getElementById(i+1).value) > 99) {
            status2 += 1;
        }
    }
    if (status == 0) {
        alert('Vennligst velg minst ett produkt!');
        } else {
            if (status2 == 0) {
                document.getElementById('bestilling').submit();
            } else {
                alert('Maks antall produkter av en sort er 99!');
            }
        }
}

function adjust(id, op, pris) {
    val = parseInt(document.getElementById(id).value);
    if (op == 0 && val > 1) {
        document.getElementById(id).value = val - 1;
        document.getElementById(id + "-p").innerHTML = ((val-1) * pris).toFixed(2) + ",-";
    } else if (op == 1 && val < 99) {
        document.getElementById(id).value = val + 1;
        document.getElementById(id + "-p").innerHTML = ((val+1) * pris).toFixed(2) + ",-";
    }
}