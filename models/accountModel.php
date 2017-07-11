<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 11.07.17
 * Time: 15:17
 */
class accountModel
{
    public static function userActivation(){
        $pdo = Db::getConnection();
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
    }

    public static function valid_login($login)
    {
        $value = htmlspecialchars(trim($login));
        $value = preg_match('/^[A-Za-z0-9 ]{3,20}$/i',$value);
        return (strlen($value) > 16 || strlen($value) < 4) ? 0 : 1 ;
    }

    public static function valid_passwd($passwd)
    {
        if(!preg_match("/[\d\w]{8,20}/i", trim($passwd)))
            return 0;
        else
            return 1;
    }

    public static function valid_email($mail){
        if (filter_var($mail, FILTER_VALIDATE_EMAIL))
            return 1;
        else
            return 0;
    }

    public static function send_mail_forgot($login, $email)
    {
        $subject = "Camagru: зміна пароля";
        $message = "Добрий день!\nВаш логин на сайті Camagru: " . $login . "\n
                Для зміни пароля перейдіть за посиланням:\n
                http://e1r1p7:8080/projects/camagru/php/new_pass.php?login=".$login."\n\n
                З повагою адміністратор, власник і всемогутній куратор сайта Camagru";
        mail($email, $subject, $message);
    }

    public static function send_mail($login, $pdo, $email)
    {
        $activ = "SELECT id FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $newact = hash('whirlpool', $activation['id']);
        $subject = "Camagru: Підтвердження реєстрації";
        $message = "Добрий день! Ви успішно зареєструвались на сайті Camagru\nВаш логін: ".$login."\n
                Для активації вашого акаунта перейдіть за посиланням:\n
                http://localhost:8080/projects/camagru/php/activation.php?login=".$login."&act=".$newact."\n\n
                З повагою адміністратор, власник і всемогутній куратор сайта Camagru";
        mail($email, $subject, $message);
    }

    public static function send_mail_coment($login, $email)
    {
        $subject = "Camagru: Ваше фото прокоментували";
        $message = "Добрий день!  ".$login." прокоментував вашу фотографію\n\n
                З повагою адміністратор, власник і всемогутній куратор сайта Camagru";
        mail($email, $subject, $message);
    }

    public static function LoginOfUser(){
        session_start();
        $login = $_SESSION['logged_user'];
        echo $login;
    }

}