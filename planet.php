<!-- https://www.anime-planet.com/ -->
<?php 
require_once('./class.anime.php');

$AnimeFlv =  new AnimeFlv();
// require_once('./include.php');
$url = str_replace(" ",'%20','https://www.anime-planet.com'.$_REQUEST['url'].'?'. http_build_query($_REQUEST) );

$html_anime = file_get_contents($url) ;

$html_anime = str_replace("<header","XXXXXXXXXX<header",$html_anime);
$html_anime = $AnimeFlv->removeScript($html_anime,'<section class="editableBanner','</section>');
$html_anime = $AnimeFlv->removeScript($html_anime,'<header','</header>');
// $html_anime = $AnimeFlv->removeScript($html_anime,'<li class="pure-u new-feature">','</li>');

$html_anime = str_replace('XXXXXXXXXX',file_get_contents('./header-planet.html'),$html_anime);

$final = str_replace('="/','="https://www.anime-planet.com/',$html_anime);
$final = str_replace("='/","='https://www.anime-planet.com/",$final);
$final = str_replace("siteLogo","",$final);
$final = str_replace('https://www.anime-planet.com/anime/','?url=/anime/',$final);
$final = str_replace('https://www.anime-planet.com/manga/','?url=/manga/',$final);
$final = str_replace('https://www.anime-planet.com/users/','?url=/users/',$final);
$final = str_replace('log in','<a href="planet.php">HOME PLANET</a> <br>
<a href="planet.php?url=/users/BryanLizana/anime/watching">View List BryanLizana</a>
',$final);

$url_search= "#";
if (strpos($_REQUEST['url'],'anime/')) {
$url_search = str_replace('/anime/','',$_REQUEST['url']);
$url_search = "search.php?q=". str_replace('-','%20',$url_search); 
}

$final = str_replace("<a class='button screenshots'","XXXXX<a class='button screenshots'",$final);
$final = $AnimeFlv->removeScript($final,"<a class='button screenshots'",'</a>');

$final = str_replace('XXXXX','<a href="'.$url_search.'" target="__black" class="button">SEARCH ANIME IN FLV</a> <br>',$final);

echo  $final; die;/***DIE***/ 

?>
<?php
require_once('./footer.php');
?>
