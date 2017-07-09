<?php
error_reporting(-1);
ini_set('display_errors','on');
require 'create_db.php';
require_once 'func_pdo.php';

$login = $_POST['login'];
$pass = $_POST['passwd'];
$conf_pass = $_POST['conf_passwd'];
$mail = $_POST['email'];

if (valid_login($login) && valid_passwd($pass) && $conf_pass == $pass && valid_email($mail))
{
        //витягуєм з бази емейли
        $mail_user = "SELECT * FROM `user` WHERE `email` = ?";
        $result_mail = $pdo->prepare($mail_user);
        $result_mail->execute([$mail]);
        $mail_exists = $result_mail->fetchAll();

        //витягуєм з бази логіни
        $login_user = "SELECT * FROM `user` WHERE `login` = ?";
        $result_login = $pdo->prepare($login_user);
        $result_login->execute([$login]);
        $login_exists = $result_login->fetchAll();

        //провіряєм чи такі існують
        if ($mail_exists != NULL || $login_exists != NULL )
        {
            if ($mail_exists && $login_exists)
                header('Location: ../html/singup.html?error=3');
            elseif ($login_exists != NULL)
                header('Location: ../html/singup.html?error=1');
            elseif ($mail_exists != NULL)
                header('Location: ../html/singup.html?error=2');
        }
        else
        {
            //заносим юзера в базу даних
            $sql = "INSERT INTO `user` (login, passwd, email, enter) VALUES (?, ?, ?, ?)";
            $result = $pdo->prepare($sql);
            $result->execute([$login, hash('whirlpool', $pass), $mail, 0]);
            send_mail($login, $pdo, $mail);
            header('Location: ../html/index.html?mail_is_send');
        }
}
else{
    header('Location: ../html/singup.html?error=4');
}
