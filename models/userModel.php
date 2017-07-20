<?php


class userModel
{
    public static function Singup($login, $pass, $mail)
    {
        $pdo = Db::getConnection();
        $sql = "INSERT INTO `user` (login, passwd, email, enter) VALUES (?, ?, ?, ?)";
        $result = $pdo->prepare($sql);
        $result->execute([$login, hash('whirlpool', $pass), $mail, 0]);
        accountModel::send_mail($login, $mail);
    }

    public static function Login($login)
    {
        session_start();
        $_SESSION['logged_user'] = $login;
    }

    public static function ForgotPassword($mail)
    {
        if ($mail) {
            $pdo = Db::getConnection();
            $login_user = "SELECT * FROM `user` WHERE `email` = ?";
            $result_login = $pdo->prepare($login_user);
            $result_login->execute([$mail]);
            $login_exists = $result_login->fetchAll();

            $activ1 = "SELECT enter FROM `user` WHERE `email` = ?";
            $result1 = $pdo->prepare($activ1);
            $result1->execute([$mail]);
            $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
            $enter = $activation1['enter'];
            if ($login_exists != NULL && $enter == "1") {
                echo "We have sent you a message. Please check your email";
                $activ = "SELECT login FROM `user` WHERE email = '$mail'";
                $result = $pdo->prepare($activ);
                $result->execute();
                $activation = $result->fetch(PDO::FETCH_ASSOC);
                $login = $activation['login'];
                accountModel::send_mail_forgot($login, $mail);
            } else {
                if ($login_exists == NULL)
                    echo "Email address does not exist";
                else
                    echo "You haven't activated your account yet";
            }
        } else {
            echo "Please fill in all fields";
        }
    }

    public static function NewPassword($pass, $pass2, $login)
    {
        $pdo = Db::getConnection();
        if ($pass2 != NULL && $pass != NULL) {
            if ($pass2 === $pass) {
                $sql = "UPDATE `user` SET passwd = '$pass' WHERE login = '$login'";
                $result = $pdo->prepare($sql);
                $result->execute();
                echo "";
            } else {
                echo "Passwords are different";
            }
        } else {
            echo "Please fill in all fields";
        }
    }

    public static function UserNewPass($new_pass1, $new_pass2, $login)
    {
        $pdo = Db::getConnection();
        $new_pass2 = hash('whirlpool', $new_pass2);
        $login = $_SESSION['logged_user'];
        $sql = "UPDATE `user` SET passwd = '$new_pass2' WHERE login = '$login'";
        $result = $pdo->prepare($sql);
        $result->execute();
        echo "Your password was successfully changed";
    }

    public static function ChackIfUserNameFree($new_name)
    {
        $pdo = Db::getConnection();
        $activ1 = "SELECT id FROM `user` WHERE login = '$new_name'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $likes = $activation1['id'];
        if ($likes > 0) {
            return false;
        }
        return true;
    }


    public static function UserNewName($new_name, $login)
    {
        $pdo = Db::getConnection();
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
        echo "Your name was successfully changed";
    }

    public static function ChackIfPassValid($conf_pass, $login)
    {
        $pdo = Db::getConnection();
        $conf_pass = hash('whirlpool', $conf_pass);
        $activ = "SELECT passwd FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $base_pass = $activation['passwd'];
        if ($base_pass == $conf_pass) {
            return true;
        }
        return false;
    }

    public static function UserDeleteAccount($login)
    {
        $pdo = Db::getConnection();
        $sql = "DELETE FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($sql);
        $result->execute();

        $sql = "DELETE FROM `gallery` WHERE user_name = '$login'";
        $result = $pdo->prepare($sql);
        $result->execute();
        $_SESSION['logged_user'] = "";
        session_unset();
        session_destroy();
    }
}


