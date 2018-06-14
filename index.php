
<?php 

require_once('./include.php');
$html_anime = file_get_contents('https://animeflv.net/') ;
$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>');
$final =  $AnimeFlv->getTags($final,'<a','</a>');
echo $final;

?>
