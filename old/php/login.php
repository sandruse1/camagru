<?php

error_reporting(-1);
ini_set('display_errors','on');
require 'create_db.php';
require_once 'func_pdo.php';

$login = $_POST['login'];
$pass = $_POST['passwd'];
$data = $_POST;

if (isset($data['forgot']))
    header('Location: ../html/forgot_pass.html');
else{
    if ($login && $pass)
{
    $pass = hash('whirlpool', $pass);

    $login_user = "SELECT * FROM `user` WHERE `login` = ?";
    $result_login = $pdo->prepare($login_user);
    $result_login->execute([$login]);
    $login_exists = $result_login->fetchAll();

    $activ = "SELECT passwd FROM `user` WHERE login = '$login'";
    $result = $pdo->prepare($activ);
    $result->execute();
    $activation = $result->fetch(PDO::FETCH_ASSOC);
    $base_pass = $activation['passwd'];

    $activ1 = "SELECT enter FROM `user` WHERE login = '$login'";
    $result1 = $pdo->prepare($activ1);
    $result1->execute();
    $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
    $enter= $activation1['enter'];

    if ($base_pass != $pass || $login_exists == NULL )
    {
        if ($login_exists == NULL)
            header('Location: ../html/login.html?error=1');
        else
            header('Location: ../html/login.html?error=2');
    }
    else if ($enter == "1")
    {
        session_start();
        $_SESSION['logged_user'] = $login;

        header('Location: ../html/main.html');

    }
    else
        header('Location: ../html/login.html?error=4');
}
else{
    header('Location: ../html/login.html?error=3');
}}
