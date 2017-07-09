<?php
require_once 'func_pdo.php';
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=', 'root', '1234');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS camagru_users";
        $pdo->exec($sql);

    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=camagru_users', 'root', '1234');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec(SQL_CREATE_MENU_TABLE);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }

try {
    $pdo = new PDO('mysql:host=localhost;dbname=camagru_users', 'root', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec(SQL_CREATE_GALLERY_TABLE);
} catch (PDOException $e) {
    exit($e->getMessage());
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=camagru_users', 'root', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec(SQL_LIKE_TABLE);
} catch (PDOException $e) {
    exit($e->getMessage());
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=camagru_users', 'root', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec(SQL_COM_TABLE);
} catch (PDOException $e) {
    exit($e->getMessage());
}
@session_start();


