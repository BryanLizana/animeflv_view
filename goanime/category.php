<?php 
require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://www1.gogoanime.sh'.$_REQUEST['url']);
  
$html_anime = classAnime::getTag($html_anime,'<ul','</ul>',"<br> \n\r",'completo',$no);

// Remplaces:
$html_anime = str_replace('="/img','="https://www1.gogoanime.sh/img',$html_anime);
$html_anime = str_replace('"/category','"interna.php?url=/',$html_anime);
$html_anime = str_replace('"/','"page.php?url=/',$html_anime);


if (strpos($html_anime,'ep_end')) {
    $list = classAnime::getTag($html_anime,'ep_end','</a>',"",'completo');
    $list_end_n = classAnime::getTag($list,"'","'","",'single');

    $url_next = str_replace('/category/','',$_REQUEST['url']);
    for ($i=1; $i < $list_end_n; $i++) { 
        echo  $url_next.'-episode-'.$i .'<br>';
    }
}
echo $html_anime;

?>
<style lang="">
    .img img{
        max-width: 200px;
    }
</style>