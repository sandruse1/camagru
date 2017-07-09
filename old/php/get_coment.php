<?php

require_once 'create_db.php';
$src = $_POST['src'];
$src = explode("gallery/", $src);
$src = $src[1];


$activ1 = "SELECT users_comented, coments FROM `coment_g` WHERE img_src = '$src'";
$result1 = $pdo->prepare($activ1);
$result1->execute();
$activation1 = $result1->fetchAll(PDO::FETCH_ASSOC);

$activ2 = "SELECT likes FROM `gallery` WHERE img_src = '../gallery/$src'";
$result2 = $pdo->prepare($activ2);
$result2->execute();
$activation2 = $result2->fetch(PDO::FETCH_ASSOC);
$text = $activation2['likes'];


foreach ($activation1 as $value ){
    $text = $text."±@±".$value['coments']."±@±".$value['users_comented'];
}
echo $text;
