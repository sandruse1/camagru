<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 11.07.17
 * Time: 15:58
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/new_pass.css">

    <title>Camagru New password</title>
</head>
<body>
<div class="top">
    <div class="p"><p>Set new Password</p></div>
    <div class="menu">
        <a href="../html/index.html">Exit</a>
        <a href="../html/singup.html">Sign up</a>
        <a href="../html/login.html">Login</a>
    </div>
    <div class="hr">
        <hr>
    </div>

</div>
<div id="main" class="main">
    <div class="img">
        <div class="forrm">
            <form id="form" method="POST" action="">
                <input type="password" name="new_passwd" placeholder="New Password"/><br><br>
                <input type="password" name="new_passwd2" placeholder="Repeat New Password"/><br><br>
                <input type="submit" name="submit" value="Change"/><br><br>
            </form>
        </div>
    </div>


</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
</body>
</html>
