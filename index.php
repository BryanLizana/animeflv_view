<?php 
require_once('./include.php');
 
$html_anime = file_get_contents('https://animeflv.net/') ;
$final = removeScript(removeScript($html_anime),'<noscript','</noscript>');


$end = true;

while ($end ) {
    
    $i = strpos($final,'<a');
    $string_final = substr($final,$i);
    $end = strpos($string_final,"</a>");
    $link_clear = substr($final,$i,$end + 4);

    if (strpos($link_clear,'<img')) {
        // try {

            
        //     $ii = strpos($link_clear,'<img');
        //     $link_clear_img = substr($link_clear,$ii);
        //     $endi = strpos($link_clear_img,">");
        //     $link_clear_img = substr($link_clear,$ii,$endi + 1);
        //    echo '<pre>'; var_dump( $link_clear_img ); echo '</pre>'; die;/***HERE***/ 
        //     $link_clear = $link_clear_img ;
             
        //  } catch (Exception $e) {
         
        //  } 
 }

    $link .= $link_clear .'<br>' ;
    $final  = substr($final,$i+$end);


}


$final = str_replace('/ver/','page.php?url=/ver/',$link);
$final = str_replace('/anime/','interna.php?url=/anime/',$final);
$final = str_replace('/uploads/','https://animeflv.net/uploads/',$final);

echo $final;

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>
