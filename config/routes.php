<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 13:18
 */

return array(

    'camagru/gallery_in_main' => 'gallery/gallery_in_main',
    'camagru/makename' => 'user/change_name',
    'camagru/profilepass' => 'user/change_password',
    'camagru/accdel' => 'user/delete_account',

    'camagru/user_set' => 'site/user_set',
    'camagru/gallery_page' => 'site/gallery',

    'camagru/singup' => 'site/singup',
    'camagru/new_pass/singup' => 'site/singup',
    'camagru/new_pass/login' => 'site/login',
    'camagru/new_pass/exit' => 'site/startpage',
    'camagru/main' => 'site/main',
    'camagru/login' => 'site/login',
    'camagru/exit' => 'site/exit',
    'camagru/forgot' => 'site/forgot',
    'camagru/new_pass/([a-zA-Z0-9]+)' => 'site/new_pass/$1',

    'camagru/change_profile' => 'user/change_profile',
    'camagru/check_email_forgot' => 'user/forgot_pass',
    'camagru/do_singup' => 'user/singup',
    'camagru/do_login' => 'user/login',
    'camagru/add_new_pass' => 'user/newpass',

    'camagru/img_plus_img' => 'gallery/img_plus_img',
    'camagru/delete_from_gallery' => 'gallery/delete_from_gallery',
    'camagru/mk_like' => 'gallery/make_like',
    'camagru/sand_comment' => 'gallery/sand_comment',
    'camagru/get_coment' => 'gallery/get_coment',
    'camagru/upload_img' => 'gallery/upload_img',


    'camagru/loged_user' => 'account/loged_user',
    'camagru/check_singup' => 'account/singup_valid',
    'camagru/check_login' => 'account/login_valid',
    'camagru/activation/([a-zA-Z0-9]+)/([a-zA-Z0-9]+)' => 'account/activate_account/$1/$2',
    'camagru' => 'site/startpage', //actionIndex в SiteController
);