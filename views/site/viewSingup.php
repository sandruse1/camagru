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
            <form id="form" method="POST" action="do_singup">
                <input type="email" name="email" placeholder="Email"/>
                <br><br>
                <input type="text" name="login" placeholder="User name"/>
                <br><br>
                <input type="password" name="passwd" placeholder="Password"/><br><br>
                <input type="password" name="conf_passwd" placeholder="Confirm Password"/><br><br>
                <input type="submit" name="submit" value="Sign up"/>
            </form>
        </div>
    </div>
</div>
<?php
require_once (ROOT.'/views/site/viewFooter.php');
?>
</body>
</html>
