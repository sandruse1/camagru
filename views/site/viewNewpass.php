<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../template/css/new_pass.css">
    <title>Camagru New Password</title>
</head>
<body>
<div class="top">
    <div class="p"><p>Set new password</p></div>
    <div class="menu">
        <a href="http://localhost:8080/camagru">Exit</a>
        <a href="http://localhost:8080/camagru/singup">Sign up</a>
        <a href="http://localhost:8080/camagru/login">Login</a>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>
<div id="main" class="main">
    <div class="img">
        <p id="massege"></p>
        <div class="forrm">
            <div id="form">
                <input type="password" id="new_passwd" name="new_passwd" placeholder="New Password"/><br><br>
                <input type="password"  id="new_passwd2" name="new_passwd2" placeholder="Repeat New Password"/><br><br>
                <input type="submit" id="submit" name="submit" value="Change"/><br><br>
            </div>
        </div>
    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<p id="hidden_p" style="display: none"><?php echo $_SESSION['forgot_login_ll']; ?></p>
<script src="../js/new_pass.js"></script>
</body>
</html>
