<?php

include_once ROOT . '/models/userModel.php';
include_once ROOT . '/models/accountModel.php';

class UserController
{
    public function actionSingup_valid(){
       accountModel::check_data_singup($_POST['login'],$_POST['passwd'],$_POST['conf_passwd'],$_POST['email']);
    }

    public function actionLogin_valid(){
        accountModel::check_data_login($_POST['login'],$_POST['passwd']);
    }

    public function actionSingup(){
            userModel::Singup($_POST['login'], $_POST['passwd'], $_POST['email']);
    }

    public function actionLogin(){
           userModel::Login($_POST['login'],$_POST['passwd']);
    }
}