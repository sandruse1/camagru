/**
 * Created by sandruse on 16.07.2017.
 */
var submit = document.getElementById("submit"),
    email = document.getElementById("email"),
    xmlreq = new XMLHttpRequest(),
    p = document.getElementById("massege");

submit.onclick = function () {
    p.innerText = "Please wait a little bit";
    xmlreq.open("POST", "check_email_forgot", true);
    xmlreq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlreq.send("email=" + email.value);
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState == 4 && xmlreq.status == 200) {
            var s = ((xmlreq.responseText).split('<!D'))[0];
            p.innerText = s;
            email.value = "";
        }
    };
}
