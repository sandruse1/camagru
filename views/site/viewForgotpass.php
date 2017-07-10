<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 18:06
 */
?>
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
       <div class="forrm">
            <p class="hell">We can help you change your password by using your e-mail<br> addresson the Camagru associated with your account.</p>
           <form id="form" method="POST" action="../php/forgot_pass.php">
                <input type="email" name="email" placeholder="Your Email"/><br><br>
                <input type="submit" name="submit" value="Send email"/>
            </form>
        </div>
   </div>
</div>
<div class="bot">
    <hr>
<p>© 2017 Camagru</p>
</div>
<script src="../js/massage.js"></script>