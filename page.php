<?php 


require_once('./include.php');

$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
// Zippyshare -> no se pudo
// Sacar los iframe
$html_anime_iframe = $html_anime;

$html_anime_iframe =  $AnimeFlv->getTags($html_anime_iframe,'<iframe','</iframe>');

$AnimeFlv->getUrlMediafire($html_anime_iframe);
echo '<br> VIDIO VIEW :';
$AnimeFlv->getUrlServerRV($html_anime_iframe);

echo '<br> ----------------';

$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'));
$final =  $AnimeFlv->getTags($final,'<a','</a>');
echo $final;
echo $html_anime_iframe;

?>


