<?php 


require_once('./include.php');



$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
// Zippyshare
// Sacar los iframe
$html_anime_iframe = $html_anime;
// https://s1.animeflv.net/efire.php?v=S1AzUStVVnpFa1UzYTZUQ3cyTmVqQmFOdTB1QWdEaXlmcEQwRXdSWjNyWERqVEVDYTNxenI2NkpqeWt0U0dOOGh3amROQ21xYkN1K1ExQVc3bkRNczF2OEhiR2thb1pjZmtadXRZUTMvTHM9

// efire.php



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


