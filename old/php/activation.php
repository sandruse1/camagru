<?php
require 'create_db.php';
if(isset($_GET['act']) AND isset($_GET['login'])) {
    $act = $_GET['act'];
    $act = stripslashes($act);
    $act = htmlspecialchars($act);

    $login = $_GET['login'];
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
}
$activ = "SELECT id FROM `user` WHERE login = '$login'";
$result = $pdo->prepare($activ);
$result->execute();
$activation = $result->fetch(PDO::FETCH_ASSOC);
$newact = hash('whirlpool', $activation['id']);
if ($newact == $act)
{
    $activ = "UPDATE `user` SET enter = '1' WHERE login = '$login'";
    $result = $pdo->prepare($activ);
    $result->execute();
    header('Location: ../html/index.html?enter_suc');
}
