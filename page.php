<?php 


require_once('./include.php');



$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
// Zippyshare
// Sacar los iframe
$html_anime_iframe = $html_anime;
$html_anime_iframe =  $AnimeFlv->getTags($html_anime_iframe,'<iframe','</iframe>');

$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'));
$final =  $AnimeFlv->getTags($final,'<a','</a>');
echo $final;
echo $html_anime_iframe;

?>


