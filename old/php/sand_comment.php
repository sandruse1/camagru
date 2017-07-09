<?php
session_start();
require_once 'create_db.php';
require_once 'func_pdo.php';
$src = $_POST['src'];
$login = $_SESSION['logged_user'];
$src = explode("gallery/", $src);
$src = $src[1];
$text = $_POST['text'];

$activ1 = "SELECT id FROM `user` WHERE login = '$login'";
$result1 = $pdo->prepare($activ1);
$result1->execute();
$activation1 = $result1->fetch(PDO::FETCH_ASSOC);
$id = $activation1['id'];

if ($id > 0){
    $sql = "INSERT INTO `coment_g` (users_comented, coments, img_src ) VALUES (?, ?, ?)";
    $result = $pdo->prepare($sql);
    $result->execute([$login, $text, $src]);

    $activ1 = "SELECT user_name FROM `gallery` WHERE img_src = '../gallery/$src'";
    $result1 = $pdo->prepare($activ1);
    $result1->execute();
    $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
    $user_name = $activation1['user_name'];

    $activ1 = "SELECT email FROM `user` WHERE login = '$user_name'";
    $result1 = $pdo->prepare($activ1);
    $result1->execute();
    $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
    $email = $activation1['email'];

    $activ1 = "SELECT email FROM `user` WHERE login = '$login'";
    $result1 = $pdo->prepare($activ1);
    $result1->execute();
    $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
    $email_login_user = $activation1['email'];

    if ($email != $email_login_user){
        send_mail_coment($login, $email_login_user);
    }
}