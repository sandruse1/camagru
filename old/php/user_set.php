<?php

error_reporting(-1);
ini_set('display_errors','on');
require 'create_db.php';
if (!(isset($_SESSION)))
session_start();
if (isset($_POST['exit']) && $_POST['exit'] == "Exit"){
    $_SESSION['logged_user'] = "";
    session_unset();
    session_destroy();
    header('Location: ../html/index.html');
}
 if (isset($_POST['back'])){
    header('Location: ../index.php');
}
 if (isset($_POST['new_pass'])){
    $new_pass1 = $_POST['new_pass1'];
    $new_pass2 = $_POST['new_pass2'];
    if ($new_pass1 == "" || $new_pass2 == "")
        header('Location: ../html/user_set.html?error=1');
    else if ($new_pass1 !== $new_pass2)
        header('Location: ../html/user_set.html?error=2');
    else{
        $new_pass2 = hash('whirlpool', $new_pass2);
        $login = $_SESSION['logged_user'];
        $sql = "UPDATE `user` SET passwd = '$new_pass2' WHERE login = '$login'";
        $result = $pdo->prepare($sql);
        $result->execute();
        header('Location: ../html/user_set.html?pass_changed');
    }
}
 if (isset($_POST['name'])){
    $new_name = $_POST['new_name'];
    $login = $_SESSION['logged_user'];
    if ($new_name == "")
        header('Location: ../html/user_set.html?error=3');
    else{

        $activ1 = "SELECT id FROM `user` WHERE login = '$new_name'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $likes = $activation1['id'];

        if ($likes > 0){
            header('Location: ../html/user_set.html?error=3');
        }
        else {

            $sql = "UPDATE `user` SET login = '$new_name' WHERE login = '$login'";
            $result = $pdo->prepare($sql);
            $result->execute();
            $_SESSION['logged_user'] = $new_name;

            $sql = "UPDATE `gallery` SET user_name = '$new_name' WHERE user_name = '$login'";
            $result = $pdo->prepare($sql);
            $result->execute();

            $sql = "UPDATE `like_g` SET users = '$new_name' WHERE users = '$login'";
            $result = $pdo->prepare($sql);
            $result->execute();
            header('Location: ../html/user_set.html?name_changed');
        }
    }
}
 if (isset($_POST['delete'])){
    $conf_pass = $_POST['conf_pass'];
    $login = $_SESSION['logged_user'];
    if ($conf_pass == ""){
        header('Location: ../html/user_set.html?error=4');
    }
    else{
        $conf_pass = hash('whirlpool', $conf_pass);
        $activ = "SELECT passwd FROM `user` WHERE login = '$login'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $activation = $result->fetch(PDO::FETCH_ASSOC);
        $base_pass = $activation['passwd'];
        if ($base_pass == $conf_pass)
        {
            $sql = "DELETE FROM `user` WHERE login = '$login'";
            $result = $pdo->prepare($sql);
            $result->execute();
            $_SESSION['logged_user'] = "";
            session_unset();
            session_destroy();
            header('Location: ../index.php');
        }
        else
            header('Location: ../html/user_set.html?error=5');
    }
}
