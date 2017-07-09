<?php
session_start();
require_once 'create_db.php';
$src = $_POST['src'];
$login = $_SESSION['logged_user'];
$src = explode("gallery/", $src);
$src = $src[1];

$activ1 = "SELECT id FROM `user` WHERE login = '$login'";
$result1 = $pdo->prepare($activ1);
$result1->execute();
$activation1 = $result1->fetch(PDO::FETCH_ASSOC);
$id = $activation1['id'];

if ($id > 0){

    $activ1 = "SELECT id FROM `like_g` WHERE users = '$login' AND img_src = '$src'";
    $result1 = $pdo->prepare($activ1);
    $result1->execute();
    $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
    $id = $activation1['id'];

    if ($id > 0){
        $activ1 = "SELECT likes FROM `like_g` WHERE users = '$login' AND img_src = '$src'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $likes = $activation1['likes'];

        $activ1 = "SELECT likes FROM `gallery` WHERE img_src = '../gallery/$src'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $likes_g = $activation1['likes'];

        if ($likes == 1){
            $sql = "UPDATE `like_g` SET likes = 0 WHERE users = '$login' AND img_src = '$src'";
            $result = $pdo->prepare($sql);
            $result->execute();

            $likes_g = $likes_g - 1;
            if ($likes_g < 0)
                $likes_g = 0;

            $sql = "UPDATE `gallery` SET likes = '$likes_g' WHERE img_src = '../gallery/$src'";
            $result = $pdo->prepare($sql);
            $result->execute();
        }
        else{

            $sql = "UPDATE `like_g` SET likes = 1 WHERE users = '$login' AND img_src = '$src'";
            $result = $pdo->prepare($sql);
            $result->execute();

            $likes_g = $likes_g + 1;

            $sql = "UPDATE `gallery` SET likes = '$likes_g' WHERE img_src = '../gallery/$src'";
            $result = $pdo->prepare($sql);
            $result->execute();
        }
    }
    else {
        $sql = "INSERT INTO `like_g` (users, likes, img_src ) VALUES (?, ?, ?)";
        $result = $pdo->prepare($sql);
        $result->execute([$login, 1, $src]);

        $likes_g = $likes_g + 1;

        $sql = "UPDATE `gallery` SET likes = '$likes_g' WHERE img_src = '../gallery/$src'";
        $result = $pdo->prepare($sql);
        $result->execute();

    }
    echo $likes_g;
}
else
    echo "-1";




