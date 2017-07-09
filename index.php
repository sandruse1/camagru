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

//Визиваєм роутер
$router = new Router();
$router->run();