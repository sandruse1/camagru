<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.07.17
 * Time: 11:40
 */
?>

<div class="top">
    <div class="p"><p>Sign Up</p></div>
    <div class="menu">
        <a href="index.html">Exit</a>
        <a href="login.html">Login</a>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>
<div class="main">
    <div class="img">
        <div class="forrm"><form id="form" method="POST" action="../php/singup.php">
                <input type="email" name="email" placeholder="Email"/>
                <br><br>
                <input type="text" name="login" placeholder="User name"/>
                <br><br>
                <input type="password" name="passwd" placeholder="Password"/><br><br>
                <input type="password" name="conf_passwd" placeholder="Confirm Password"/><br><br>
                <input type="submit" name="submit" value="Sign up"/>
            </form></div>
    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="../js/massage.js"></script>
