<?php

error_reporting(-1);
ini_set('display_errors','on');
require 'create_db.php';

if (array_key_exists('sr', $_POST)) {

    $img = $_POST['sr'];
    $login = $_POST['user_name'];
    $frame = $_POST['fr_src'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);

    $sql = "INSERT INTO `gallery` (user_name) VALUES (?)";
    $result = $pdo->prepare($sql);
    $result->execute([$login]);

    $activ = "SELECT MAX(id) FROM `gallery`";
    $result = $pdo->prepare($activ);
    $result->execute();
    $id = $result->fetch(PDO::FETCH_ASSOC);
    $n = $id['MAX(id)'];


    $activ = "UPDATE `gallery` SET img_src = '../gallery/$n.png' WHERE id = '$n'";
    $result = $pdo->prepare($activ);
    $result->execute();
    file_put_contents("../gallery/$n.png", $data);

    $Image = ImageCreateFromPNG("../gallery/$n.png");
    $logo = ImageCreateFromPNG("../frame/$frame");


    if ($frame == "frame1.png")
        ImageCopy($Image, $logo, 0, 0, 0, 0, 350, 200);
    elseif ($frame == "color.png")
        ImageCopy($Image, $logo, 0, 0, 0, 0, 350, 400);
    elseif ($frame == "girl.png")
        ImageCopy($Image, $logo, 0, 0, 0, 0, 200, 400);

    imagepng($Image, "../gallery/$n.png");


}
