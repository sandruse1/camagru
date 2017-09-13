<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 11.07.17
 * Time: 16:06
 */
class galleryModel
{

    public  function resizePng($im, $dst_width, $dst_height) {
        $width = imagesx($im);
        $height = imagesy($im);
        $newImg = imagecreatetruecolor($dst_width, $dst_height);
        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
        imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
        return $newImg;
    }

    public static function ImgPlusImg($img, $login, $frame){
        $pdo = Db::getConnection();
        if ($img != "./gallery/".$login.".png"){
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        }
        else{
$k = 1;
            $data = ImageCreateFromPNG("./gallery/".$login.".png");
            $dst_width = 400;
            $dst_height = 400;
            $width = imagesx($data);
            $height = imagesy($data);
            $newImg = imagecreatetruecolor($dst_width, $dst_height);
            imagealphablending($newImg, false);
            imagesavealpha($newImg, true);
            $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
            imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
            imagecopyresampled($newImg, $data, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
$data = $newImg;
        }
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
        if ($k != 1) {
            file_put_contents("./gallery/$n.png", $data);
        }else{
            imagepng($data, "./gallery/$n.png");
        }
        $Image = ImageCreateFromPNG("./gallery/$n.png");
        $logo = ImageCreateFromPNG("./img/frame/$frame");
        if ($frame == "frame1.png")
            ImageCopy($Image, $logo, 0, 0, 0, 0, 350, 200);
        elseif ($frame == "color.png")
            ImageCopy($Image, $logo, 0, 0, 0, 0, 350, 400);
        elseif ($frame == "girl.png")
            ImageCopy($Image, $logo, 0, 0, 0, 0, 200, 400);
        imagepng($Image, "./gallery/$n.png");
//        if ($k){ unlink("./gallery/".$login.".png");}
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

    public static function GetComment($src){
        $pdo = Db::getConnection();
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

    public static function MakeLike($login, $src){
        $pdo = Db::getConnection();
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

    public function send_mail_coment($login, $email)
    {
        $subject = "Camagru: Ваше фото прокоментували";
        $message = "Добрий день!  ".$login." прокоментував вашу фотографію\n\n
                З повагою адміністратор, власник і всемогутній куратор сайта Camagru";
        mail($email, $subject, $message);
    }

    public static function SendComment($login, $src, $text){
        $pdo = Db::getConnection();
        $src = explode("gallery/", $src);
        $src = $src[1];
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
                galleryModel::send_mail_coment($login, $email_login_user);
            }
        }
    }

    public static function UploadPhoto(){
        session_start();


        $login = $_SESSION['loged_user'];
        if(!empty($_FILES['photo_file']['tmp_name'])){
            if(!empty($_FILES['photo_file']['error'])){
                header("Location: http://localhost:8080/camagru/main?error=2"); // помилка загрузки
            }
            elseif ($_FILES['photo_file']['size'] > 2*1024*1024){
                header("Location: http://localhost:8080/camagru/main?error=3"); ///файл завеликий
            }
            switch ($_FILES['photo_file']['type']){
                case 'image/png';
                case 'image/x-png';
                    $type = 'png';
                    break;
                default:
                    header("Location: http://localhost:8080/camagru/main?error=4"); //неправильний формат файла
            }
            if(!move_uploaded_file($_FILES['photo_file']['tmp_name'], "./gallery/$login.png")){
                header("Location: http://localhost:8080/camagru/main?error=5"); //не вдалось загрузити файл
            }
            header("Location: http://localhost:8080/camagru/main"); //все добре
        }
        else
            header("Location: http://localhost:8080/camagru/main?error=1"); //ви не вибрали файл
    }
}