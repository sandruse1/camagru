<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 12:52
 */
//Загальні настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Підключення файлів системи

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');

//Створюєм в файлі сесії необхідні змінні які будем використовувати

if (!isset($_SESSION['logged_user'])) {
    $_SESSION['logged_user'] = "";
}
if (!isset($_SESSION['activation'])) {
    $_SESSION['activation'] = "";
}
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = "";
}

//Визиваєм роутер

$router = new Router();
$router->run();