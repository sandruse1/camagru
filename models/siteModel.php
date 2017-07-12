<?php

class siteModel
{
    public static function CreateDB(){
        Db::createTable('users');
        Db::createTable('gallery');
        Db::createTable('like');
        Db::createTable('comment');
    }
}