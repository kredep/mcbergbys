        var x = document.querySelectorAll(".fade-in");
        [].forEach.call(x, function(el) {
            el.classList.remove('fade-in');
        });
        var step = 0;
        function sleep(ms) {
            return new Promise (resolve => setTimeout(resolve, ms));
        }
        async function KeyDownEvent(e) {
            var limit = 12;
            var expand = 15;
            var box = document.getElementById("box");
            var user = document.getElementById("user");
            var pass = document.getElementById("pass");
            var info = document.getElementById("info");
            var gcon = document.getElementById("gcon");
            var symbol = document.getElementById("symbol");
            var login = document.getElementById("login");
            var title = document.getElementById("title");
            if (e.which == 13 && step == 0) {
                if (user.value == "") {
                    login.classList.add('error');
                    gcon.classList.add('error');
                    await sleep(1000);
                    login.classList.remove('error');
                    gcon.classList.remove('error');
                } else {
                    info.classList.add('fadeOut');
                    gcon.classList.add('fadeOut');
                    user.classList.add('fadeOut');
                    await sleep(250);
                    if (box.offsetWidth != 304) {
                        box.style.width = 300 + "px";
                    }
                    info.classList.remove('fadeOut');
                    info.innerHTML = "passord";
                    info.classList.add('fadeIn');
                    gcon.classList.remove('fadeOut');
                    symbol.className = "glyphicon glyphicon-lock";
                    gcon.classList.add('fadeIn');
                    user.classList.remove('fadeOut');
                    pass.classList.add('fadeIn');
                    user.style.visibility = "hidden";
                    pass.style.visibility = "visible";
                    await sleep(250);
                    info.classList.remove('fadeOut');
                    gcon.classList.remove('fadeIn');
                    login.classList.remove('resize');
                    pass.focus();
                    step += 1;
                }
            } else if(e.which == 13 && step == 1) {
                if (pass.value == "")
                {
                    login.classList.add('error');
                    gcon.classList.add('error');
                    await sleep(1000);
                    login.classList.remove('error');
                    gcon.classList.remove('error');
                } else {
                    login.classList.add('fadeOut');
                    title.classList.add('fadeOut');
                    document.getElementById("login_form").submit();
                }
            } else {
                var detail;
                if (step == 0) {
                        detail = user;
                        var n = user.value.length;
                    } else {
                        detail = pass;
                        var n = pass.value.length;
                    }
                if (n > limit) {
                    if (box.offsetWidth < screen.width - 190) {
                        box.style.width = 300 + (n-limit)*expand + "px";
                        detail.style.width = 190 + (n-limit)*expand + "px";
                    } else {
                        box.style.width = screen.width - 190 + "px";
                        detail.style.width = screen.width - 280 + "px";
                    }
                } else if (box.offsetWidth != 304) {
                    box.style.width = 300 + "px";
                    detail.style.width = 190 + "px";
                }
            }
        }