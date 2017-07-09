<?php

error_reporting(-1);
ini_set('display_errors','on');
require 'create_db.php';
require_once 'func_pdo.php';

$mail = $_POST['email'];

if ($mail)
{
    $login_user = "SELECT * FROM `user` WHERE `email` = ?";
    $result_login = $pdo->prepare($login_user);
    $result_login->execute([$mail]);
    $login_exists = $result_login->fetchAll();

    $activ1 = "SELECT enter FROM `user` WHERE `email` = ?";
    $result1 = $pdo->prepare($activ1);
    $result1->execute([$mail]);
    $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
    $enter = $activation1['enter'];
    if ($login_exists != NULL && $enter == "1")
    {
        $activ = "SELECT login FROM `user` WHERE email = '$mail'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $login = $activation['login'];
        send_mail_forgot($login, $mail);
        header('Location: ../html/index.html?mail_is_send');
    }
    else
    {
        if ($login_exists == NULL)
            header('Location: ../html/forgot_pass.html?error=1');
        else
            header('Location: ../html/forgot_pass.html?error=2');
    }
}
else{
    header('Location: ../html/forgot_pass.html?error=3');
}
