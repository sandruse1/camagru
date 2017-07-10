<?php
    require_once (ROOT.'/views/site/viewHeader');
?>

<div class="top">
    <div class="p"><p>Login</p></div>
    <div class="menu">
        <a href="index.html">Exit</a>
        <a href="singup.html">Sign up</a>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>
<div class="main">
    <div class="img">
        <div class="forrm">
            <form id="form" method="POST" action="../php/login.php">
                 <input type="text" name="login" placeholder="User name"/>
                    <br><br>
                <input type="password" name="passwd" placeholder="Password"/><br><br>
                <input type="submit" name="submit" value="Login"/>
                <input type="submit" name="forgot" value="Forgot password?"/>
            </form>
        </div>
    </div>
</div>
<div class="bot">
    <hr>
<p>© 2017 Camagru</p>
</div>
<script src="../js/massage.js"></script>

<?php
    require_once (ROOT.'/views/site/viewFooter');
?>