<?php 
function converter_link(String $var = null)
{
    
    $i = strpos($var,'href="');
    $var_resto = substr($var,$i);
    $end = strpos($var_resto,'">');
    if ($end) {
        $url_clean = str_replace('href="' , '',substr($var,$i -1,$end -2 ));
        $url_clean = str_replace('" class="Button Sm fa-downl' , '',$url_clean);
        $url_clean = str_replace('http://ouo.io/s/y0d65LCP?s=' , '',$url_clean);
        
        $url_clean = urldecode($url_clean);
        $url_clean = str_replace(' ' , '',$url_clean);
        return '<a href="paso_final.php?url='.$url_clean.'&back='.$_SERVER['REQUEST_URI'].'">'.$url_clean.'</a>'.'   =====<a href="'.$url_clean.'" target="__black">View Site</a>';

    }    else {
        return $var;
    }
  
}

$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
$final = str_replace( 'script','',$html_anime);
// $final = strip_tags( $html_anime);
// EN EMISION
// $i = strpos($final,'<ul class="ListSdbr">');
// $string_final = substr($final,$i);
// $end = strpos($string_final,"</ul>");

$end = true;

$ini = 0;
$link = "";

while ($end && $ini < 100) {
    
    $i = strpos($final,'Zippyshare');
    
    $string_final = substr($final,$i);
    $end = strpos($string_final,"</table>");
    $link_clear = converter_link(substr($final,$i,$end));
    $link .= $link_clear . "<br>";
    $final  = substr($final,$i+$end);
    $ini++;
}

echo $link;
// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>

<br>
<a href="<?php echo  $_REQUEST['back'] ?>">atrás</a>