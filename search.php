<?php 
require_once('./include.php');


$url = str_replace(" ",'%20','https://animeflv.net/browse?'. http_build_query($_REQUEST) );


$html_anime = file_get_contents($url) ;
$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'));
$final =  $AnimeFlv->getTags($final,'<a','</a>');
echo $final;
?>

