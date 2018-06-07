<?php 


$html_anime = file_get_contents('https://animeflv.net/') ;
$final = str_replace( 'script','',$html_anime);
// $final = strip_tags( $html_anime);
// EN EMISION
// $i = strpos($final,'<ul class="ListSdbr">');
// $string_final = substr($final,$i);
// $end = strpos($string_final,"</ul>");

$end = true;

$ini = 0;
$link = "";

    $i = strpos($final,'<main');
    
    $string_final = substr($final,$i);
    $end = strpos($string_final,"</main>");
    $final = str_replace('/ver','interna?url=/ver',substr($final,$i,$end));
    $final = str_replace('/anime','interna?url=/anime',$final);

echo $final;

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>

<br>
<a href="<?php echo  $_REQUEST['back'] ?>">atrás</a>