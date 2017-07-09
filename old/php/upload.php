<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 07.07.17
 * Time: 14:48
 */

session_start();
$login = $_SESSION['logged_user'];

if(!empty($_FILES['photo_file']['tmp_name'])){

    if(!empty($_FILES['photo_file']['error'])){
        header("Location: ../html/main.html?error=2"); // помилка загрузки
    }
    elseif ($_FILES['photo_file']['size'] > 2*1024*1024){
        header("Location: ../html/main.html?error=3"); ///файл завеликий
    }

    switch ($_FILES['photo_file']['type']){

        case 'image/png';
        case 'image/x-png';
        $type = 'png';
        break;

        default:
            header("Location: ../html/main.html?error=4"); //неправильний формат файла
    }

    if(!move_uploaded_file($_FILES['photo_file']['tmp_name'], "../gallery/$login.$type")){
        header("Location: ../html/main.html?error=5"); //не вдалось загрузити файл
    }
    header("Location: ../html/main.html"); //все добре
}
else
    header("Location: ../html/main.html?error=1"); //ви не вибрали файл
