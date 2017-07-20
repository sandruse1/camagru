/**
 * Created by sandruse on 20.07.17.
 */
var do_exit = document.getElementById('exit'),
    go_back = document.getElementById('back'),
    change_name = document.getElementById('change_name'),
    change_pass = document.getElementById('change_pass'),
    change_pass2 = document.getElementById('change_pass2'),
    delete_account = document.getElementById('delete_account'),
    p = document.getElementById("massege"),
    xmlhttp = new XMLHttpRequest();

do_exit.onclick = function () {
    location.href= ' http://localhost:8080/camagru/exit';
}

go_back.onclick = function () {
    location.href= ' http://localhost:8080/camagru/main';
}

function change_user_name() {
    if (change_name.value != "") {
        xmlhttp.open("POST", "makename", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("user_name=" + change_name.value);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var result = xmlhttp.responseText;
                if (result != ""){
                    error(result);
                }
            }
        };
    }
    else
        error("Please fill in all fields");
}

function change_user_pass() {
    if (change_pass.value != "" && change_pass2.value != "") {
        xmlhttp.open("POST", "profilepass", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("new_pass=" + change_pass.value + "&new_pass2=" + change_pass2.value);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var result = xmlhttp.responseText;
                if (result != ""){
                    error(result);
                }
            }
        };
    }
    else
        error("Please fill in all fields");
}

function delete_user_account() {
    if (delete_account.value != "") {
        xmlhttp.open("POST", "accdel", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("delete_pass=" + delete_account.value);
        location.href= ' http://localhost:8080/camagru/main';
    }
    else
        error("Please fill in all fields");
}

function error(str) {
    p.innerText = str;
}