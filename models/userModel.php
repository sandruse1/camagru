<?php


class userModel
{
    public static function Singup($login, $pass, $mail){
        $pdo = Db::getConnection();
        $sql = "INSERT INTO `user` (login, passwd, email, enter) VALUES (?, ?, ?, ?)";
        $result = $pdo->prepare($sql);
        $result->execute([$login, hash('whirlpool', $pass), $mail, 0]);
        accountModel::send_mail($login,$mail);
    }

    public static function Login($login) {
        session_start();
        $_SESSION['logged_user'] = $login;
    }

    public static function ForgotPassword($mail){
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
        }
        else{
            echo "Please fill in all fields";
        }
    }

    public static function NewPassword($pass, $pass2, $login){
        $pdo = Db::getConnection();
        if ($pass2 != NULL && $pass != NULL) {
            if ($pass2 === $pass) {
              $sql = "UPDATE `user` SET passwd = '$pass' WHERE login = '$login'";
               $result = $pdo->prepare($sql);
                $result->execute();
               echo "";
            } else { echo "Passwords are different"; }
        } else { echo "Please fill in all fields"; }
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
    }
}