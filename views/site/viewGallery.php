<?php
//include 'add_img_to_gallery.php';
//$dir = '../gallery/';
//$images = get_img($dir);
//require_once 'pagination.php';
include_once(ROOT . '/models/paginationModel.php');

$tmp = new paginationModel($_SESSION);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./template/css/gallery.css">
    <title>Camagru Gallery</title>
</head>
<body>
<div class="top">
    <div class="p"><p>GALLERY</p></div>
    <div class="menu">
        <div id="menu">
            <input type="submit" onclick="location.href = 'http://localhost:8080/camagru/main'" name="back" value="<< Back"/>
            <input type="submit" onclick="location.href = 'http://localhost:8080/camagru/exit'" name="exit" value="Exit"/>
        </div>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>

<div class="main">
    <div class="wrapper">
        <div class="gallery">
            <?php if ($tmp->img): $i = $tmp->start_pos + 1; ?>
                <?php for($j = $tmp->start_pos; $j < $tmp->end_pos; $j++):?>
                    <div class="item">
                        <div>
                            <img class="front" src="<?=$tmp->dir.$tmp->img[$j]?>" onclick="show_hidden(this.src)" alt="photo">
                            <img class="back" src="./img/css_img/sandruse.png" onclick="show_hidden('<?=$tmp->dir.$tmp->img[$j]?>')" alt="icon">
                        </div>
                    </div>
                    <?php $i++; endfor; ?>
            <?php else: ?>
                <p>В даній галереї немає жодної фотографії</p>
            <?php endif; ?>
            <?php if($tmp->count_pages > 1): ?>
                <div class="clear"></div>
                <div class="pagination"><?=$tmp->pagination?></div>
            <?php endif; ?>
        </div>

    </div>
</div>





<div class="hidden" id="hidden">
    <img src="./img/css_img/exit.png" id="exit" alt="">
    <img id="main_photo" src="" alt="photo">

    <div id="like_div">
        <img src="./img/css_img/like.jpg" id="like" alt="like">
        <p id="how_much"></p>
    </div>

    <div id="coment_div">
        <textarea name="sdsd" id="coment" cols="30" rows="10"></textarea>
        <input type="button" id="send" value="Send">
        <input type="button" id="cancel" value="Cancel">
    </div>

    <div class="coments" id="coment_list">

    </div>
</div>
<div class="bot">
    <hr>
    <p>© 2017 Camagru</p>
</div>
<script src="./js/gallery.js"></script>
</body>
</html>
