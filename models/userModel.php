<?php


class userModel
{
    public static function Singup(){
        $queryPath = ROOT.'/config/querySQL.php';
        $querySQL = include($queryPath);
        $pdo = Db::getConnection();
        Db::createTable('users');

        if (isset($_POST['signup'])) {
            $login = $_POST['login'];
            $pass = $_POST['passwd'];
            $conf_pass = $_POST['conf_passwd'];
            $mail = $_POST['email'];

            if (valid_login($login) && valid_passwd($pass) && $conf_pass == $pass && valid_email($mail)) {
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
                if ($mail_exists != NULL || $login_exists != NULL) {
//                if ($mail_exists && $login_exists)
//                    header('Location: ../html/singup.html?error=3');
//                elseif ($login_exists != NULL)
//                    header('Location: ../html/singup.html?error=1');
//                elseif ($mail_exists != NULL)
//                    header('Location: ../html/singup.html?error=2');
                } else {
                    //заносим юзера в базу даних
                    $sql = "INSERT INTO `user` (login, passwd, email, enter) VALUES (?, ?, ?, ?)";
                    $result = $pdo->prepare($sql);
                    $result->execute([$login, hash('whirlpool', $pass), $mail, 0]);
                    send_mail($login, $pdo, $mail);
                    header('Location: ../html/index.html?mail_is_send');
                }
            }
//        else{
//            header('Location: ../html/singup.html?error=4');
//        }
        }
        require_once (ROOT.'/views/site/viewSingup.php');
    }

    public static function Login()
    {
        $pdo = Db::getConnection();

        if (isset($_POST['signup'])) {
            $login = $_POST['login'];
            $pass = $_POST['passwd'];

            if ($login && $pass) {
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
                $enter = $activation1['enter'];

                if ($base_pass != $pass || $login_exists == NULL) {
                    if ($login_exists == NULL)
                        header('Location: ../html/login.html?error=1');
                    else
                        header('Location: ../html/login.html?error=2');
                    } else if ($enter == "1") {
                        session_start();
                        $_SESSION['logged_user'] = $login;

                        header('Location: ../html/main.html');

                    } else
                        header('Location: ../html/login.html?error=4');
                } else {
                    header('Location: ../html/login.html?error=3');
            }
        }
        require_once (ROOT.'/views/site/viewLogin.php');
    }

    public static function UserSettings(){
        $pdo = Db::getConnection();
        if (isset($_POST['new_pass'])){
            $new_pass1 = $_POST['new_pass1'];
            $new_pass2 = $_POST['new_pass2'];
            if ($new_pass1 == "" || $new_pass2 == "")
                header('Location: ../html/user_set.html?error=1');
            else if ($new_pass1 !== $new_pass2)
                header('Location: ../html/user_set.html?error=2');
            else{
                $new_pass2 = hash('whirlpool', $new_pass2);
                $login = $_SESSION['logged_user'];
                $sql = "UPDATE `user` SET passwd = '$new_pass2' WHERE login = '$login'";
                $result = $pdo->prepare($sql);
                $result->execute();
                header('Location: ../html/user_set.html?pass_changed');
            }
        }
        if (isset($_POST['name'])){
            $new_name = $_POST['new_name'];
            $login = $_SESSION['logged_user'];
            if ($new_name == "")
                header('Location: ../html/user_set.html?error=3');
            else{

                $activ1 = "SELECT id FROM `user` WHERE login = '$new_name'";
                $result1 = $pdo->prepare($activ1);
                $result1->execute();
                $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
                $likes = $activation1['id'];

                if ($likes > 0){
                    header('Location: ../html/user_set.html?error=3');
                }
                else {

                    $sql = "UPDATE `user` SET login = '$new_name' WHERE login = '$login'";
                    $result = $pdo->prepare($sql);
                    $result->execute();
                    $_SESSION['logged_user'] = $new_name;

                    $sql = "UPDATE `gallery` SET user_name = '$new_name' WHERE user_name = '$login'";
                    $result = $pdo->prepare($sql);
                    $result->execute();

                    $sql = "UPDATE `like_g` SET users = '$new_name' WHERE users = '$login'";
                    $result = $pdo->prepare($sql);
                    $result->execute();
                    header('Location: ../html/user_set.html?name_changed');
                }
            }
        }
        if (isset($_POST['delete'])){
            $conf_pass = $_POST['conf_pass'];
            $login = $_SESSION['logged_user'];
            if ($conf_pass == ""){
                header('Location: ../html/user_set.html?error=4');
            }
            else{
                $conf_pass = hash('whirlpool', $conf_pass);
                $activ = "SELECT passwd FROM `user` WHERE login = '$login'";
                $result = $pdo->prepare($activ);
                $result->execute();
                $activation = $result->fetch(PDO::FETCH_ASSOC);
                $base_pass = $activation['passwd'];
                if ($base_pass == $conf_pass)
                {
                    $sql = "DELETE FROM `user` WHERE login = '$login'";
                    $result = $pdo->prepare($sql);
                    $result->execute();
                    $_SESSION['logged_user'] = "";
                    session_unset();
                    session_destroy();
                    header('Location: ../index.php');
                }
                else
                    header('Location: ../html/user_set.html?error=5');
            }
        }
        require_once (ROOT.'/views/site/viewUsersettings.php');
    }

    public static function ForgotPassword(){

        $pdo = Db::getConnection();
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
        require_once (ROOT.'/views/site/viewUsersettings.php');
    }

    public static function NewPassword(){
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
        require_once (ROOT.'/views/site/viewNewpass.php');
    }
}