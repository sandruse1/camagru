<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 15:45
 */
class Db
{
    public static function getConnection(){
        $paramsPath = ROOT.'/config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        return $db;
    }
}