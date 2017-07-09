<?php
include 'add_img_to_gallery.php';
$dir = '../gallery/';

$images = get_img($dir);

require_once 'pagination.php';

// формуєм і виводим
if($images): $i = $start_pos+1; $output = null;
    for($j = $start_pos; $j < $end_pos; $j++):
        $output .= '<div class="item">';
        $output .= '<div>';
        $output .= '<img class="front" src="' .$dir .$images[$j]. '" onclick="show_hidden(this.src)" alt="photo">';
        $output .= '<img class="back" src="../img/sandruse.png" onclick="show_hidden(\'' .$dir.$images[$j].'\')" alt="icon">';
        $output .= '</div>';
        $output .= '</div>';
        $i++; endfor;
endif;

echo $output . '<div class="clear"></div><div class="pagination">' .$pagination. '</div>';

