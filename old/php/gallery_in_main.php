<?php
require_once 'create_db.php';
$login = $_POST['user_name'];
$activ = "SELECT img_src FROM `gallery` WHERE user_name = '$login'";
$result = $pdo->prepare($activ);
$result->execute();
$array = array();
$src = $result->fetchAll(PDO::FETCH_ASSOC);
foreach ($src as $elem){
    array_push($array, $elem['img_src']);
}

$array = implode(",", $array);
echo $array;