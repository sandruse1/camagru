(function() {

    var a = window.location,
        b = a['search'],
        z = a['pathname'],
        text = "",
        form = document.getElementById("form"),
        p = document.createElement("p");

    p.className = "error";
    p.style.fontWeight = "bold";
    if (z != "/projects/camagru/html/index.html")
        p.style.color = "red";
    else
        p.style.color = "darkgreen";
    if (b != "" )
    {
        if (z == "/projects/camagru/html/index.html")
            text = index_massage(b, text);
        else if (z == "/projects/camagru/html/forgot_pass.html")
            text = forgot_pass_error(b, text);
        else if (z == "/projects/camagru/html/login.html")
            text = login_error(b , text);
        else if (z == "/projects/camagru/html/singup.html")
            text = singup_error(b , text);
        else if (z == "/projects/camagru/php/new_pass.php")
            text = new_pass_error(b, text);
        else if (z == "/projects/camagru/html/user_set.html")
            text = user_set_error(b, text);
        if(text){
            p.innerHTML = text;
            form.insertBefore(p, form.firstChild);}
    }
})();

 function index_massage(b , text)
 {
     if (b == "?mail_is_send"){text = "We send you a message. Pleace check your Email";}
     else if (b == "?enter_suc"){text = "Activation successfully completed. Now you can log in";}
     else if (b == "?pass_changed"){text = "Your password was successfully changed";}
     return text;
 }

 function forgot_pass_error(b, text)
 {
     if (b == "?error=1"){ text = "NO such user";}
     else if (b == "?error=2"){text = "You don't confirm your email. Please just do it";}
     else if (b == "?error=3"){text = "Please fill in all form fields";}
     return text;
 }

function login_error(b, text)
{
    if (b == "?error=1"){ text = "NO such user";}
    else if (b == "?error=2"){text = "Wrong password. Please enter another";}
    else if (b == "?error=3"){text = "Please fill in all form fields";}
    else if (b == "?error=4"){text = "You don't confirm your email. Please just do it";}
    return text;
}

function singup_error(b, text)
{
    if (b == "?error=1"){ text = "Such login already exists in database";}
    else if (b == "?error=2"){text = "Such mail already exists in database";}
    else if (b == "?error=3"){text = "Such mail and login already exists in database";}
    else if (b == "?error=4"){text = "Please fill in all form fields correctly";}
    return text;
}

function new_pass_error(b, text)
{
    if (b == "?error=1"){ text = "Passwords are different";}
    else if (b == "?error=2"){text = "Please fill in all form fields";}
    return text;
}

function user_set_error(b, text)
{
    if (b == "?error=1"){ text = "Please fill in all form fields";}
    else if (b == "?error=2"){text = "Passwords are different";}
    else if (b == "?error=3"){text = "Please fill in all form fields";}
    else if (b == "?error=4"){text = "Please fill in all form fields";}
    else if (b == "?error=5"){text = "Wrong password!";}
    else if (b == "?name_changed"){text = "Your name was successfully changed";}
    else if (b == "?pass_changed"){text = "Your password was successfully changed";}
    return text;
}
