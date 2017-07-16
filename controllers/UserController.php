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

    public function actionNew_pass(){
        echo "2";
        $pass= $_POST['pass']; $pass2 = $_POST['pass2']; $login = $_POST['login'];
        if (accountModel::valid_passwd_singup($pass, $pass2)) {
            $pass = hash('whirlpool', $pass);
            $pass2 = hash('whirlpool', $pass2);
            userModel::NewPassword($pass, $pass2, $login);
        }
        else{ echo "Password must be at least 8 characters"; }
        return true;
    }
}