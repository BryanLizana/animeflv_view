<?php 
echo  '<a href="index.php">Home</a><br><br><br>';
echo  'https://www5.gogoanime.in'.$_REQUEST['url'].'<br>';
require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://www5.gogoanime.in'.$_REQUEST['url']);

$url_rap = classAnime::getTag($html_anime,'https://www.rapidvideo.com','">');

// Remplaces:
$anime_list = explode('-episode',$_REQUEST['url']);

echo  '<a href="category.php?url=/category'.$anime_list[0].'">'.$anime_list[0] .'</a><br><br><br>';

$classAnime =  new classAnime();
$url_rap =  str_replace('">','',$url_rap);
$classAnime->getUrlServerRVCopy($url_rap);

// $html_anime = str_replace('"/','"page.php?url=/',$html_anime);
$html_anime = classAnime::getTag($html_anime,'<ul','</ul>',"<br> \n\r",'completo',$no);
echo $html_anime;

?>



<style lang="">
    .img img{
         max-width: 200px;
    }
</style>