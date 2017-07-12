<?php

class siteModel
{
    public static function CreateDB(){
        Db::createTable('user');
        Db::createTable('gallery');
        Db::createTable('like');
        Db::createTable('comment');
    }
}