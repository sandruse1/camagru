<?php

class siteModel
{
    public static function CreateDB(){
        Db::createTable('user');
        Db::createTable('gallery');
        Db::createTable('like');
        Db::createTable('comment');
        if (!file_exists(ROOT.'/gallery')) {
            mkdir(ROOT . '/gallery', 0700);
        }
    }

}