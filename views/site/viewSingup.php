<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./template/css/singup.css">
    <title>Camagru Singup</title>
</head>
<body>
<div class="top">
    <div class="p"><p>Sign Up</p></div>
    <div class="menu">
        <a href="camagru">Back</a>
        <a href="login">Login</a>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>
<div class="main">
    <div class="img">
        <div class="forrm">
            <p id="massege" style="color: red"> </p>
            <div id="form">
                <input type="email" id="email" name="email" placeholder="Email"/>
                <br><br>
                <input type="text" id="login" name="login" placeholder="User name"/>
                <br><br>
                <input type="password" id="pass" name="passwd" placeholder="Password"/><br><br>
                <input type="password" id="c_pass" name="conf_passwd" placeholder="Confirm Password"/><br><br>
                <input type="submit" id="submit" name="submit" value="Sign up"/>
            </div>
        </div>
    </div>
</div>
<script src="./js/singup.js"></script>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
</body>
</html>
