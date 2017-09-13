<?php

class siteModel
{
    public static function CreateDB(){
        Db::createTable('com');
        Db::createTable('user');
        Db::createTable('gallery');
        Db::createTable('like');

        if (!file_exists(ROOT.'/gallery')) {
            mkdir(ROOT . '/gallery', 0700);
        }
    }

}