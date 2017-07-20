<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 11.07.17
 * Time: 16:06
 */
class galleryModel
{
    public static function ImgPlusImg($img, $login, $frame){
        $pdo = Db::getConnection();
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
        $activ = "UPDATE `gallery` SET img_src = './gallery/$n.png' WHERE id = '$n'";
        $result = $pdo->prepare($activ);
        $result->execute();
        file_put_contents("./gallery/$n.png", $data);
        $Image = ImageCreateFromPNG("./gallery/$n.png");
        $logo = ImageCreateFromPNG("./img/frame/$frame");
        if ($frame == "frame1.png")
            ImageCopy($Image, $logo, 0, 0, 0, 0, 350, 200);
        elseif ($frame == "color.png")
            ImageCopy($Image, $logo, 0, 0, 0, 0, 350, 400);
        elseif ($frame == "girl.png")
            ImageCopy($Image, $logo, 0, 0, 0, 0, 200, 400);
        imagepng($Image, "./gallery/$n.png");
        echo "./gallery/$n.png";
    }

    public static function Delete_from_gallery($src){
        $pdo = Db::getConnection();
        $activ = "DELETE FROM `gallery` WHERE img_src = './gallery/$src'";
        $result = $pdo->prepare($activ);
        $result->execute();
        unlink("./gallery/$src");
    }

    public static function GelleryInMain($login){
        $pdo = Db::getConnection();
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
    }

    public static function GetComment(){
        $pdo = Db::getConnection();
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
    }

    public static function MakeLike(){
        $pdo = Db::getConnection();
        $src = $_POST['src'];
        $login = $_SESSION['logged_user'];
        $src = explode("gallery/", $src);
        $src = $src[1];
        $activ1 = "SELECT id FROM `user` WHERE login = '$login'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $id = $activation1['id'];
        $likes_g = 0;
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
    }

    public static function SendComment(){
        $pdo = Db::getConnection();
        $src = $_POST['src'];
        $login = $_SESSION['logged_user'];
        $src = explode("gallery/", $src);
        $src = $src[1];
        $text = $_POST['text'];
        $activ1 = "SELECT id FROM `user` WHERE login = '$login'";
        $result1 = $pdo->prepare($activ1);
        $result1->execute();
        $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
        $id = $activation1['id'];
        if ($id > 0){
            $sql = "INSERT INTO `coment_g` (users_comented, coments, img_src ) VALUES (?, ?, ?)";
            $result = $pdo->prepare($sql);
            $result->execute([$login, $text, $src]);
            $activ1 = "SELECT user_name FROM `gallery` WHERE img_src = '../gallery/$src'";
            $result1 = $pdo->prepare($activ1);
            $result1->execute();
            $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
            $user_name = $activation1['user_name'];
            $activ1 = "SELECT email FROM `user` WHERE login = '$user_name'";
            $result1 = $pdo->prepare($activ1);
            $result1->execute();
            $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
            $email = $activation1['email'];
            $activ1 = "SELECT email FROM `user` WHERE login = '$login'";
            $result1 = $pdo->prepare($activ1);
            $result1->execute();
            $activation1 = $result1->fetch(PDO::FETCH_ASSOC);
            $email_login_user = $activation1['email'];
            if ($email != $email_login_user){
                send_mail_coment($login, $email_login_user);
            }
        }
    }

    public static function UploadPhoto(){
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
    }
}