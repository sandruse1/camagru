<?php
error_reporting(-1);
ini_set('display_errors','on');

require_once 'create_db.php';
require_once 'func_pdo.php';
$data = $_POST;
$login = $_GET['login'];

if (isset($data['submit'])) {
    $pass = $_POST['new_passwd'];
    $pass2 = $_POST['new_passwd2'];
    if ($pass2 != NULL && $pass != NULL) {
        $pass = hash('whirlpool', $pass);
        $pass2 = hash('whirlpool', $pass2);
        if ($pass2 === $pass) {
            $sql = "UPDATE `user` SET passwd = '$pass' WHERE login = '$login'";
            $result = $pdo->prepare($sql);
            $result->execute();
           header('Location: ../html/index.html?pass_changed');
        } else {
            header("Location: new_pass.php?login=".$login."&error=1");
        }
    } else {
        header("Location: new_pass.php?login=".$login."&error=2");
    }
}
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
<script src="../js/massage.js"></script>
</body>
</html>