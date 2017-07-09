<?php

error_reporting(-1);
ini_set('display_errors','on');
require 'create_db.php';
$login = $_GET['login'];

if ($_POST['exit'] == "Exit"){
    $_SESSION['logged_user'] = "";
    session_unset();
    session_destroy();
    header('Location: ../index.php');
}
else if ($_POST['gallery'] == "Gallery")
{
    header('Location: gallery.php');
}
else if ($_POST['back'] == "<< Back"){
    header('Location: ../index.php');
}
else if ($_POST['name'] == $login){
    header('Location: ../html/user_set.html');
}

