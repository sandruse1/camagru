<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 17:28
 */
class SiteController
{
    public function actionIndex()
    {
        require_once(ROOT.'/views/site/index.php');

        return true;
    }
}