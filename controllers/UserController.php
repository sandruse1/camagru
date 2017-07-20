<?php

include_once ROOT . '/models/userModel.php';
include_once ROOT . '/models/accountModel.php';

class UserController
{
    public function actionSingup(){
        userModel::Singup($_POST['login'], $_POST['passwd'], $_POST['email']);
        return true;
    }

    public function actionLogin(){
        userModel::Login($_POST['login']);
        return true;
    }

    public function actionForgot_pass(){
        userModel::ForgotPassword($_POST['email']);
        return true;
    }

    public function actionNewpass(){
        $pass= $_POST['pass']; $pass2 = $_POST['pass2']; $login = $_POST['login'];
        if (accountModel::valid_passwd_singup($pass, $pass2)) {
            $pass = hash('whirlpool', $pass);
            $pass2 = hash('whirlpool', $pass2);
            userModel::NewPassword($pass, $pass2, $login);
        }
        else{ echo "Password must be at least 8 characters"; }
        return true;
    }

    public function actionChange_name(){
        session_start();
        $login = $_SESSION['logged_user'];
        if (userModel::ChackIfUserNameFree($_POST['user_name']) && accountModel::valid_login_singup($_POST['user_name'])){
            $_SESSION['logged_user'] = $login;
            userModel::UserNewName($_POST['user_name'], $login);

        }
        else
            echo "Such user name already exist or you new name is invalid";
        return true;
    }

    public function actionChange_password(){
        session_start();
        $login = $_SESSION['logged_user'];
        if (accountModel::valid_passwd_singup($_POST['new_pass'],$_POST['new_pass2'])) {
            userModel::UserNewPass(['new_pass'],$_POST['new_pass2'], $login);
        }
        else
            echo "Not valid passwords";
        return true;
    }

    public function actionDelete_account(){
        session_start();
        $login = $_SESSION['logged_user'];
        if (userModel::ChackIfPassValid($_POST['delete_pass'], $login)) {
            userModel::UserDeleteAccount($login);
            require_once(ROOT.'/views/site/viewStartpage.php');
        }
        else
            echo "Wrong password try again";
        return true;
    }
}