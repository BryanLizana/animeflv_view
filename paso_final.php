<?php 

function converter_link(String $var = null)
{
    
    $i = strpos($var,'="');
    $var_resto = substr($var,$i);
    $end = strpos($var_resto,'">');
    if ($end) {
        $url_clean = str_replace('" class="fa-play-circle' , '',substr($var,$i +2,$end -2 ));

        return '<a href="interna.php?url='.$url_clean.'">'.$url_clean.'</a>';

    }    else {
        return $var;
    }
  
}

$html_anime = file_get_contents($_REQUEST['url']) ;
$final = str_replace( 'script','',$html_anime);
// $final = strip_tags( $html_anime);
// EN EMISION
// $i = strpos($final,'<ul class="ListSdbr">');
// $string_final = substr($final,$i);
// $end = strpos($string_final,"</ul>");

$end = true;

$ini = 0;
$link = "";
// while ($end && $ini < 100) {
    
    $i = strpos($final,'[url=//');
    // https://www112.zippyshare.com/d/nGinuf6V/75/7_833.mp4
    $string_final = substr($final,$i);
    $end = strpos($string_final,"[/url]");
    $link_clear = converter_link(substr($final,$i,$end));
    $link .= $link_clear . "<br>";
    $final  = substr($final,$i+$end);
    $ini++;
// }

echo $link;

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>