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

        try {
            $dsn = "mysql:host={$params['host']};dbname=";
            $pdo = new PDO($dsn, $params['user'], $params['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Connection error :". $e->getMessage();
            exit();
        }

        $query = 'CREATE DATABASE IF NOT EXISTS `camagru`';
        try {
            $pdo->query($query);
        } catch (PDOException $e)        {
            echo "Error: Can't CREATE DataBase - ".$e;
            exit();
        }

        try {
            $pdo = new PDO("mysql:host={$params['host']};dbname={$params['dbname']}", $params['user'], $params['password']);
        } catch (PDOException $e) {
            echo "Connection error :". $e->getMessage();
            exit();
        }
        return $pdo;
    }

    public static function createTable($type){
        $queryPath = ROOT.'/config/queryDbSql.php';
        $query = include($queryPath);

        try {
            $pdo = Db::getConnection();
        } catch (PDOException $e){
            echo "Connection error :". $e->getMessage();
            exit();
        }

        $tableName = 'create'.ucfirst($type);
        $queryCreate = $query[$tableName];

        try{
            $pdo->query($queryCreate);
        }catch (PDOException $e){
            echo "Error: Can't CREATE TABLE - ".$e->getMessage();
            exit();
        }
    }

    public function insertTable($type){
        $queryPath = ROOT.'/config/queryDbSql.php';
        $query = include($queryPath);

        try {
            $pdo = Db::getConnection();
        } catch (PDOException $e){
            echo "Connection error :". $e->getMessage();
            exit();
        }

        $tableName = 'insert'.ucfirst($type);
        $queryCreate = $query[$tableName];

        try{
            $pdo->query($queryCreate);
        }catch (PDOException $e){
            echo "Error: Can't CREATE TABLE - ".$e->getMessage();
            exit();
        }
    }
}