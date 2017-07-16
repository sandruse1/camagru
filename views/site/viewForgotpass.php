<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 18:06
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./template/css/index.css">
    <title>Camagru Forgot password</title>
</head>
<div class="top">
    <div class="p"><p>Reset the password</p></div>
    <div class="menu">
        <a href="index.html">Exit</a>
        <a href="singup.html">Sign up</a>
        <a href="login.html">Login</a>
    </div>
    <div class="hr">
        <hr>
    </div>

</div>
<div class="main">
   <div class="img">
       <p id="massege"></p>
       <div class="forrm">
            <p class="hell">We can help you change your password by using your e-mail<br> addresson the Camagru associated with your account.</p>
           <div id="form">
                <input type="email" id="email" name="email" placeholder="Your Email"/><br><br>
                <input type="submit" id="submit" name="submit" value="Send email"/>
            </div>
        </div>
   </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="./js/forgot.js"></script>
</body>
</html>
