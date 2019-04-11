<?php 
echo  '<a href="index.php">Home</a><br><br><br>';

require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://www5.gogoanime.tv'.$_REQUEST['url']);
$no = array('https://www5.gogoanime.tv','Login','Sign up');
$html_anime = classAnime::getTag($html_anime,'<ul','</ul>',"<br> \n\r",'completo',$no);
$html_anime = classAnime::removeTag($html_anime,'TEXTOBEFOREXXX','TEXTOAFTERXXX');
// Remplaces:
$html_anime = str_replace('="/img','="https://www5.gogoanime.tv/img',$html_anime);
$html_anime = str_replace('"/category','"interna.php?url=/',$html_anime);
$html_anime = str_replace('"/','"page.php?url=/',$html_anime);


if (strpos($html_anime,'ep_end')) {
    $list = classAnime::getTag($html_anime,'ep_end','</a>',"",'completo');
    $list_end_n = classAnime::getTag($list,"'","'","",'single');

    $url_next = str_replace('/category/','',$_REQUEST['url']);
    for ($i=1; $i <= $list_end_n; $i++) { 
        echo  '<a href="page.php?url=/'.$url_next.'-episode-'.$i .'">'.$url_next.'-episode-'.$i .'</a><br><br><br>';
    }
}
echo $html_anime;

?>

<style lang="">
    .img img{
        max-width: 200px;
    }
</style>