/**
 * Created by sandruse on 13.07.17.
 */
var submit = document.getElementById("submit"),
    email = document.getElementById("email"),
    login = document.getElementById("login"),
    pass = document.getElementById("pass"),
    c_pass = document.getElementById("c_pass"),
    p = document.getElementById("massege"),
    xmlreq = new XMLHttpRequest(),
    xmlreq2 = new XMLHttpRequest();

submit.onclick = function () {

    xmlreq.open("POST", "check_login", true);
    xmlreq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq.send("login=" + login.value + "&passwd=" + pass.value);
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState == 4 && xmlreq.status == 200) {
            var s = ((xmlreq.responseText).split('<!D'))[0];
            if (s == '') { do_login(); }
            else{ p.innerText = s; }
        }
    };
}

function do_login() {
    xmlreq2.open("POST", "do_login", true);
    xmlreq2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq2.send();
}