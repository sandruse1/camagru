/**
 * Created by sandruse on 12.07.17.
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

    xmlreq.open("POST", "check_singup", true);
    xmlreq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq.send("login=" + login.value + "&passwd=" + pass.value + "&conf_passwd=" + c_pass.value + "&email=" + email.value);
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState == 4 && xmlreq.status == 200) {
            var s = ((xmlreq.responseText).split('<!D'))[0];
            if (s == '') {
                do_singup();
                p.innerText = "Check your email. We send you a massage";
                clean_field();
                }
             else{ p.innerText = s; }
        }
    };
}

function do_singup() {
    xmlreq2.open("POST", "do_singup", true);
    xmlreq2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq2.send("login=" + login.value + "&passwd=" + pass.value + "&email=" + email.value);
}

function clean_field() {
    email.value = "";
    login.value = "";
    pass.value = "";
    c_pass.value = "";
}