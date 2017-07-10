<?php

include_once ROOT.'/models/siteModel.php';

class SiteController
{
    public function actionStartpage()
    {
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
}