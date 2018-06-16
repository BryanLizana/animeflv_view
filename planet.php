<!-- https://www.anime-planet.com/ -->
<h1>VIEWPROFILE BRYAN LIZANA</h1>

<?php 
// require_once('./include.php');

$html_anime = file_get_contents('https://www.anime-planet.com'.$_REQUEST['url']) ;


$final = str_replace('="/','="https://www.anime-planet.com/',$html_anime);
$final = str_replace("='/","='https://www.anime-planet.com/",$final);
$final = str_replace('https://www.anime-planet.com/anime/','?url=/anime/',$final);
$final = str_replace('https://www.anime-planet.com/manga/','?url=/manga/',$final);
$final = str_replace('https://www.anime-planet.com/users/','?url=/users/',$final);
$final = str_replace('log in','<a href="/planet.php">HOME PLANET</a> <br>
<a href="/planet.php?url=/users/BryanLizana/anime/watching">View List BryanLizana</a>
',$final);

$url_search= "#";
if (strpos($_REQUEST['url'],'anime/')) {
$url_search = str_replace('/anime/','',$_REQUEST['url']);
$url_search = "search.php?q=". str_replace('-','%20',$url_search); 
}
$final = str_replace('Rank','<a href="'.$url_search.'" target="__black">SEARCH ANIME IN FLV</a> <br>Rank',$final);

echo  $final; die;/***DIE***/ 

?>
<?php
require_once('./footer.php');
?>
