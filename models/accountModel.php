<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 11.07.17
 * Time: 15:17
 */
class accountModel
{
    public static function userActivation($act, $login){
        $pdo = Db::getConnection();
        $act = htmlspecialchars(stripslashes($act));
        $login = htmlspecialchars(stripslashes($login));
        $activ = "SELECT id FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $newact = hash('whirlpool', $activation['id']);
        if ($newact == $act) {
            $activ = "UPDATE `user` SET enter = '1' WHERE login = '$login'";
            $result = $pdo->prepare($activ);
            $result->execute();
        }
        session_start();
        $_SESSION['logged_user'] = $login;
    }

    public static function check_data_singup($login, $passwd, $conf_passwd, $email){

        if ($login == NULL || $passwd == NULL || $conf_passwd == NULL || $email == NULL){
            $str = "Fill in all fields";
            echo $str;
        }
        elseif (!accountModel::valid_login_singup($login)){
            echo "not valid login";
        }
        elseif(!accountModel::valid_passwd_singup($passwd, $conf_passwd)){
            echo "not valid password";
        }elseif (!accountModel::valid_email_singup($email)){
            echo "not valid email";
        }else{
            echo "";
        }
    }

    public static function check_data_login($login, $pass){
        if ($login == NULL || $pass == NULL ){
            $str = "Fill in all fields";
            echo $str;
        }
        elseif (!accountModel::valid_login_login($login)){
            echo "not valid login";
        }
        elseif(!accountModel::valid_passwd_login($pass, $login)) {
            echo "not valid password";
        }else{
            echo "";
        }

    }

    public static function valid_login_singup($login) {
        $pdo = Db::getConnection();
        $login_user = "SELECT * FROM `user` WHERE `login` = '$login'";
        $login_exists = $pdo->prepare($login_user);
        $login_exists->execute();
        $login_exists = $login_exists->fetchAll();
        $value = trim($login);
        if (strlen($value) > 16 || strlen($value) < 4 ||  $login_exists != NULL){

            return 0;
        }
        return 1;
    }

    public static function valid_login_login($login){
        $pdo = Db::getConnection();
        $login_user = "SELECT * FROM `user` WHERE `login` = ?";
        $result_login = $pdo->prepare($login_user);
        $result_login->execute([$login]);
        $login_exists = $result_login->fetchAll();
        if ($login_exists == NULL)
            return 0;
        return 1;
    }

    public static function valid_passwd_singup($passwd, $conf_pass)    {
        if(!preg_match("/[\d\w]{8,20}/i", trim($passwd)) || $passwd != $conf_pass)
            return 0;
        else
            return 1;
    }

    public static function valid_passwd_login($pass, $login){
        $pdo = Db::getConnection();
        $pass = hash('whirlpool', $pass);
        $activ = "SELECT passwd FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $base_pass = $activation['passwd'];
        if ($base_pass == $pass)
            return 1;
        return 0;
    }

    public static function valid_confirm_from_mail($login){
        $pdo = Db::getConnection();
        $activ1 = "SELECT enter FROM `user` WHERE login = '$login'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $enter = $activation1['enter'];
        if ($enter == "1")
            return 1;
        return 0;
    }

    public static function valid_email_singup($mail){
        $pdo = Db::getConnection();
        $mail_user = "SELECT * FROM `user` WHERE `email` = '$mail'";
        $mail_exists = $pdo->prepare($mail_user);
        $mail_exists->execute();
        $mail_exists = $mail_exists->fetchAll();
        if (filter_var($mail, FILTER_VALIDATE_EMAIL) && $mail_exists == NULL)
            return 1;
        else
            return 0;
    }

    public static function send_mail_forgot($login, $email) {
        $headers = "Content-Type: text/html; charset=utf-8"."\r\n";
        $subject = "Camagru Forgot password";
        $r1 = "<html><head><style>.button { background-color: #646464; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
        $r2 = "<body><h1>Camagru Forgot password</h1>";
        $r3 = "<article><p>Hi, {$login}!</p><p>To reset your password please click here</p>";
        $r4 = "<a href='http://localhost:/camagru/new_pass/{$login}' class='button'>Reset</a></article>";
        $r5 = "<p>Best regards, Camagru Dev</p></body></html>";
        $message = $r1.$r2.$r3.$r4.$r5;
        mail($email, $subject, $message, $headers);
    }

    public static function send_mail($login,$email)
    {
        $pdo = Db::getConnection();
        $activ = "SELECT id FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $id = hash('whirlpool', $activation['id']);
        $headers = "Content-Type: text/html; charset=utf-8"."\r\n";
        $subject = "Camagru Account Activation";
        $r1 = "<html><head><style>.button { background-color: #646464; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
        $r2 = "<body><h1>Camagru Account Activation</h1>";
        $r3 = "<article><p>Hi, {$login}!</p><p>Thanks for registration on <span>Camagru<span></p><p>To activate your account on site please click on button below</p>";
        $r4 = "<a href='http://localhost:/camagru/activation/{$login}/{$id}' class='button'>Activate</a></article>";
        $r5 = "<p>Best regards, Camagru Dev</p></body></html>";
        $message = $r1.$r2.$r3.$r4.$r5;
        mail($email, $subject, $message, $headers);
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