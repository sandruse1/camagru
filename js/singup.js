/**
 * Created by sandruse on 12.07.17.
 */
var submit = document.getElementById("submit"),
    login = document.getElementById("login"),
    pass = document.getElementById("pass"),
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
            if (s == '') { do_singup(); }
             else{ p.innerText = s; }
        }
    };
}

function do_singup() {
    xmlreq2.open("POST", "do_singup", true);
    xmlreq2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq2.send("login=" + login.value + "&passwd=" + pass.value + "&email=" + email.value);
}