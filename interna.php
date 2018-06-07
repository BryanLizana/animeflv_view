<?php 


$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;

$final = $html_anime;

$end = true;

while ($end ) {
    
    $i = strpos($final,'<a');
    $string_final = substr($final,$i);
    $end = strpos($string_final,"</a>");
    $link_clear = substr($final,$i,$end + 4);

    $link .= $link_clear .'<br>' ;
    $final  = substr($final,$i+$end);
}


    $final = str_replace('/ver','page?url=/ver',$link);
    $final = str_replace('/anime','page?url=/anime',$final);

echo $final;

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>

<br>
<a href="<?php echo  $_REQUEST['back'] ?>">atrás</a>