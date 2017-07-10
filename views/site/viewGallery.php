<?php
//include 'add_img_to_gallery.php';
//$dir = '../gallery/';
//$images = get_img($dir);
//require_once 'pagination.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/gallery.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Camagru Gallery</title>
</head>
<body>
<div class="top">
    <div class="p"><p>GALLERY</p></div>
    <div class="menu">
        <form id="menu" method="POST" action="../php/menu.php">
            <input type="submit" name="back" value="<< Back"/>
            <input type="submit" name="exit" value="Exit"/>
        </form>
    </div>
    <div class="hr">
        <hr>
    </div>
</div>

<div class="main">
    <p>з jquery в js</p>
    <div class="wrapper">
        <div class="gallery">
            <?php if ($images): $i = $start_pos + 1; ?>
                <?php for($j = $start_pos; $j < $end_pos; $j++):?>
                    <div class="item">
                        <div>
                            <img class="front" src="<?=$dir.$images[$j]?>" onclick="show_hidden(this.src)" alt="photo">
                            <img class="back" src="../img/sandruse.png" onclick="show_hidden('<?=$dir.$images[$j]?>')" alt="icon">
                        </div>
                    </div>
                    <?php $i++; endfor; ?>
            <?php else: ?>
                <p>В даній галереї немає жодної фотографії</p>
            <?php endif; ?>
            <?php if($count_pages > 1): ?>
                <div class="clear"></div>
                <div class="pagination"><?=$pagination?></div>
            <?php endif; ?>
        </div>

    </div>

</div>
<div class="hidden" id="hidden">
    <img src="../img/exit.png" id="exit" alt="">
    <img id="main_photo" src="" alt="photo">

    <div id="like_div">
        <img src="../img/like.jpg" id="like" alt="like">
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
<script src="../js/gallery.js"></script>
</body>
</html>
