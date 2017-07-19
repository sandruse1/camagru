<?php

include_once ROOT.'/models/siteModel.php';
include_once ROOT.'/models/galleryModel.php';

class SiteController
{
    public function actionStartpage()
    {
        siteModel::CreateDB();
        require_once(ROOT.'/views/site/viewStartpage.php');
        return true;
    }

    public function actionGallery()
    {
        require_once(ROOT.'/views/site/viewGallery.php');
        return true;
    }

    public function actionSingup()
    {
        require_once(ROOT.'/views/site/viewSingup.php');
        return true;
    }

    public function actionLogin()
    {
        require_once(ROOT.'/views/site/viewLogin.php');
        return true;
    }

    public function actionMain(){
        require_once(ROOT.'/views/site/viewMain.php');
        return true;
    }

    public function actionForgot(){
        require_once(ROOT.'/views/site/viewForgotpass.php');
        return true;
    }

    public function actionNew_pass($login){
        session_start();
       $_SESSION['forgot_login_ll'] = $login;
       require_once(ROOT.'/views/site/viewNewpass.php');
       return true;
    }
}