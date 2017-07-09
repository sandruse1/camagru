<?php
require_once 'create_db.php';

 const SQL_CREATE_MENU_TABLE = 'CREATE TABLE IF NOT EXISTS `user`
(id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, 
login VARCHAR(60) NOT NULL, 
email VARCHAR(60) NOT NULL, 
passwd VARCHAR(500), 
enter INT DEFAULT 0)';

const SQL_CREATE_GALLERY_TABLE = 'CREATE TABLE IF NOT EXISTS `gallery`
(id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, 
user_name VARCHAR(255) NOT NULL, 
likes INT DEFAULT 0,
img_src VARCHAR(555) DEFAULT "")';

const SQL_LIKE_TABLE = 'CREATE TABLE IF NOT EXISTS `like_g`
(id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, 
users VARCHAR(50) NOT NULL, 
likes INT DEFAULT 0,
img_src VARCHAR(20) DEFAULT "")';

const SQL_COM_TABLE = 'CREATE TABLE IF NOT EXISTS `coment_g`
(id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, 
users_comented VARCHAR(50) NOT NULL, 
coments VARCHAR(100000) NOT NULL,
img_src VARCHAR(20))';

function valid_login($login)
{
    $value = htmlspecialchars(trim($login));
    $value = preg_match('/^[A-Za-z0-9 ]{3,20}$/i',$value);
    return (strlen($value) > 16 || strlen($value) < 4) ? 0 : 1 ;
}

function valid_passwd($passwd)
{
    if(!preg_match("/[\d\w]{8,20}/i", trim($passwd)))
        return 0;
    else
        return 1;
}

function valid_email($mail){
    if (filter_var($mail, FILTER_VALIDATE_EMAIL))
        return 1;
    else
        return 0;
}

function send_mail_forgot($login, $email)
{
    $subject = "Camagru: зміна пароля";
    $message = "Добрий день!\nВаш логин на сайті Camagru: " . $login . "\n
                Для зміни пароля перейдіть за посиланням:\n
                http://e1r1p7:8080/projects/camagru/php/new_pass.php?login=".$login."\n\n
                З повагою адміністратор, власник і всемогутній куратор сайта Camagru";
    mail($email, $subject, $message);
}

function send_mail($login, $pdo, $email)
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

function send_mail_coment($login, $email)
{
    $subject = "Camagru: Ваше фото прокоментували";
    $message = "Добрий день!  ".$login." прокоментував вашу фотографію\n\n
                З повагою адміністратор, власник і всемогутній куратор сайта Camagru";
    mail($email, $subject, $message);
}
