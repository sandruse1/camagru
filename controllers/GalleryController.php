<?php

include_once ROOT.'/models/galleryModel.php';

class GalleryController
{
    public static function actionImg_plus_img(){
        if (isset($_POST['sr']) && isset($_POST['user_name']) && isset($_POST['fr_src'])) {
            galleryModel::ImgPlusImg($_POST['sr'], $_POST['user_name'], $_POST['fr_src']);
        }
        return true;
    }

    public static function actionDelete_from_gallery(){
        if (isset($_POST['sr'])) {
            galleryModel::Delete_from_gallery($_POST['sr']);
        }
        return true;
    }

    public static function actionGallery_in_main(){
        if (isset($_POST['user_name'])) {
            galleryModel::GelleryInMain($_POST['user_name']);
        }
        return true;
    }
}