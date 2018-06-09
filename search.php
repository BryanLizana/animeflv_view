<?php 
require_once('./include.php');

$url = str_replace(" ",'%20','https://animeflv.net/browse?q='.$_REQUEST['q'] );
$html_anime = file_get_contents($url) ;
$final = removeScript(removeScript($html_anime),'<noscript','</noscript>');

$end = true;

while ($end ) {
    $i = strpos($final,'<a');
    $string_final = substr($final,$i);
    $end = strpos($string_final,"</a>");
    $link_clear = substr($final,$i,$end + 4);
    $link .= $link_clear .'<br>' ;
    $final  = substr($final,$i+$end);
}
    $final = str_replace('/ver/','page.php?url=/ver/',$link);
    $final = str_replace('/anime/','interna.php?url=/anime/',$final);
    $final = str_replace('/uploads/','https://animeflv.net/uploads/',$final);
    $final = str_replace('/browse?','search.php?',$final);

    
echo $final;

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>

