<?php 

require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://www1.gogoanime.sh'.$_REQUEST['url']);

$url_rap = classAnime::getTag($html_anime,'https://www.rapidvideo.com','">');

// Remplaces:
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