var submit = document.getElementById("submit"),
    pass = document.getElementById("new_passwd"),
    pass2 = document.getElementById("new_passwd2"),
    p = document.getElementById("massege"),
    div = document.getElementById("form"),
    xmlreq = new XMLHttpRequest(),
    h_p = document.getElementById("hidden_p"),
    login = h_p.innerText;

submit.onclick = function () {

    xmlreq.open("POST", "http://localhost:8080/camagru/add_new_pass", true);
    xmlreq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq.send("pass=" + pass.value + "&pass2=" + pass2.value + "&login=" + login);
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState == 4 && xmlreq.status == 200) {
            var s = ((xmlreq.responseText).split('<!D'))[0];
            console.log(s);
                if (s == '') {
                    p.innerText = "Your password was successfully changed";
                    hide_field();
                }
                else{ p.innerText = s; }
        }
    };
}


function hide_field() {
    div.style.display = "none";
}
