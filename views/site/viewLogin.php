<?php
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./template/css/singup.css">
        <title>Camagru Login</title>
    </head>
    <body>
<div class="top">
    <div class="p"><p>Login</p></div>
    <div class="menu">
        <a href="camagru">Back</a>
        <a href="singup">Sign up</a>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>
<div class="main">
    <div class="img">
        <div class="forrm">
            <form id="form" >
                <p id="massege"></p>
                 <input type="text" id="login" name="login" placeholder="User name"/>
                    <br><br>
                <input type="password" id="pass" name="passwd" placeholder="Password"/><br><br>
                <input type="submit" id="submit" name="submit" value="Login"/>
                <input type="submit" name="forgot" value="Forgot password?"/>
            </form>
        </div>
    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="./js/login.js"></script>
    </body>
</html>