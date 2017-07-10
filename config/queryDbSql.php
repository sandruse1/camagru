<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.07.17
 * Time: 10:57
 */

$query = array(
    'createUser' => 'CREATE TABLE IF NOT EXISTS `user` (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(60) NOT NULL, email VARCHAR(60) NOT NULL, passwd VARCHAR(500), enter INT DEFAULT 0)',
    'insertUser' =>  'INSERT INTO `users` (login, email, passwd, enter) VALUES (?, ?, ?, ?)',
    'createGallery' => 'CREATE TABLE IF NOT EXISTS `gallery` (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) NOT NULL, likes INT DEFAULT 0, img_src VARCHAR(555) DEFAULT "")',
    'insertGallery' => 'INSERT INTO `gallery` (user_name, likes, img_src) VALUES (?, ?, ?)',
    'createLike' => 'CREATE TABLE IF NOT EXISTS `like_g` (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, users VARCHAR(50) NOT NULL, likes INT DEFAULT 0, img_src VARCHAR(20) DEFAULT "")',
    'createComment' => 'CREATE TABLE IF NOT EXISTS `coment_g` (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, users_comented VARCHAR(50) NOT NULL, coments VARCHAR(100000) NOT NULL, img_src VARCHAR(20))'
);

return ($query);