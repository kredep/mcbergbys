var subbuttons = document.querySelector(".subbutton");
subbuttons.addEventListener("focus", function() {
    subbuttons.parentElement.classList.add("dropdown-visible");
});
function hideSub() {
    document.getElementById("submenu").classList.remove("dropdown-visible");
}