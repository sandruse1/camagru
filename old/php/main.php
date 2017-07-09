<?php
error_reporting(-1);
ini_set('display_errors','on');
session_start();
$login = $_SESSION['logged_user'];
echo $login;