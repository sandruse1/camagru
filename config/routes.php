<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 09.07.17
 * Time: 13:18
 */

return array(
    'camagru/gallery' => 'site/gallery',
    'camagru/singup' => 'site/singup',
    'camagru/main' => 'site/main',
    'camagru/login' => 'site/login',
    'camagru/exit' => 'site/exit',
    'camagru/forgot' => 'site/forgot',
    'camagru/new_pass/([a-zA-Z0-9]+)' => 'site/new_pass/$1',

    'camagru/check_email_forgot' => 'user/forgot_pass',
    'camagru/do_singup' => 'user/singup',
    'camagru/do_login' => 'user/login',
    'camagru/add_new_pass' => 'user/new_pass',

    'camagru/check_singup' => 'account/singup_valid',
    'camagru/check_login' => 'account/login_valid',
    'camagru/activation/([a-zA-Z0-9]+)/([a-zA-Z0-9]+)' => 'account/activate_account/$1/$2',

    'camagru' => 'site/startpage', //actionIndex в SiteController
);