<?php

include_once ROOT . '/models/userModel.php';
include_once ROOT . '/models/accountModel.php';

class UserController
{
    public function actionSingup(){
        if (accountModel::valid_login_singup($_POST['login']) && accountModel::valid_passwd_singup($_POST['passwd'],$_POST['conf_passwd']) && accountModel::valid_email_singup($_POST['email'])) {
            userModel::Singup($_POST['login'], $_POST['passwd'], $_POST['conf_passwd'], $_POST['email']);
        }
        else{
            //функція помилок
        }
    }

    public function actionLogin(){
        if ($_POST['login'] && $_POST['passwd']){
            userModel::Login($_POST['login'],$_POST['passwd']);
        }
    }
}