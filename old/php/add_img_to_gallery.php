<?php
function get_img($dir){
@$files = scandir($dir);
$pattern = '#\.(jpe?g|png|gif)$#i';

foreach ($files as $key => $file) {
    if (!preg_match($pattern, $file)) {
        unset($files[0], $files[1]);
    }
}
$files = array_merge($files);
if ($files[0] == ".DS_Store"){
    unset($files[0]);
    $files = array_merge($files);
}
return $files;

}

/**
 * Пагінація
 **/
function pagination($page, $count_pages, $modrew = false){
    // << < 3 4 5 6 7 > >>
    $back = null; // ссылка НАЗАД
    $forward = null; // ссылка ВПЕРЕД
    $startpage = null; // ссылка В НАЧАЛО
    $endpage = null; // ссылка В КОНЕЦ
    $page2left = null; // вторая страница слева
    $page1left = null; // первая страница слева
    $page2right = null; // вторая страница справа
    $page1right = null; // первая страница справа

    $uri = "?";
    if(!$modrew){
        // если есть параметры в запросе
        if( $_SERVER['QUERY_STRING'] ){
            foreach ($_GET as $key => $value) {
                if( $key != 'page' ) $uri .= "{$key}=$value&amp;";
            }
        }
    }else{
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("?", $url);
        if(isset($url[1]) && $url[1] != ''){
            $params = explode("&", $url[1]);
            foreach($params as $param){
                if(!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
    }

    if( $page > 1 ){
        $back = "<a class='nav-link' data-page='" .($page-1). "' href='{$uri}page=" .($page-1). "'>&lt;</a>";
    }
    if( $page < $count_pages ){
        $forward = "<a class='nav-link' data-page='" .($page+1). "' href='{$uri}page=" .($page+1). "'>&gt;</a>";
    }
    if( $page > 3 ){
        $startpage = "<a class='nav-link' data-page='1' href='{$uri}page=1'>&laquo;</a>";
    }
    if( $page < ($count_pages - 2) ){
        $endpage = "<a class='nav-link' data-page='" .$count_pages. "' href='{$uri}page={$count_pages}'>&raquo;</a>";
    }
    if( $page - 2 > 0 ){
        $page2left = "<a class='nav-link' data-page='" .($page-2). "' href='{$uri}page=" .($page-2). "'>" .($page-2). "</a>";
    }
    if( $page - 1 > 0 ){
        $page1left = "<a class='nav-link' data-page='" .($page-1). "' href='{$uri}page=" .($page-1). "'>" .($page-1). "</a>";
    }
    if( $page + 1 <= $count_pages ){
        $page1right = "<a class='nav-link' data-page='" .($page+1). "' href='{$uri}page=" .($page+1). "'>" .($page+1). "</a>";
    }
    if( $page + 2 <= $count_pages ){
        $page2right = "<a class='nav-link' data-page='" .($page+2). "' href='{$uri}page=" .($page+2). "'>" .($page+2). "</a>";
    }

    return $startpage.$back.$page2left.$page1left.'<a class="nav-active">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage;
}