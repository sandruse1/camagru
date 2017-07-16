<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 11.07.17
 * Time: 17:03
 */
class AccountController
{
    public function actionSingup_valid(){
        accountModel::check_data_singup($_POST['login'],$_POST['passwd'],$_POST['conf_passwd'],$_POST['email']);
        return true;
    }

    public function actionLogin_valid(){
        accountModel::check_data_login($_POST['login'],$_POST['passwd']);
        return true;
    }

    public function actionActivate_account($login, $act)
    {
        accountModel::userActivation($act, $login);
        require_once(ROOT.'/views/site/viewMain.php');
        return true;
    }
}