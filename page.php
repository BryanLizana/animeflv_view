<?php 


function removeScript($text_full,$text_before="<script",$text_after="</script>")
{
    // <script
    // </script>
    $end= true;
    while ($end ) {
    
        $i = strpos($text_full,$text_before);
        $string_final = substr($text_full,$i);
        $end = strpos($string_final,$text_after);
        $link_clear = substr($text_full,$i,($end ));
        $text_full =  str_replace($link_clear,"",$text_full);
    } 
    $text_full =  str_replace($text_after,"",$text_full);

    return $text_full;

}


$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
// Zippyshare
$final = removeScript(removeScript($html_anime),'<noscript','</noscript>');

$end = true;

while ($end ) {
    
    $i = strpos($final,'<a');
    $string_final = substr($final,$i);
    $end = strpos($string_final,"</a>");
    $link_clear = substr($final,$i,$end + 4 );



    if (strpos($link_clear,'http://ouo.io/s/y0d65LCP?s=')) {
           try {
                $a = new SimpleXMLElement($link_clear);

                $url_clean = str_replace('http://ouo.io/s/y0d65LCP?s=' , '',$a['href']);
                $url_clean = urldecode($url_clean);
                
                $link_clear = '<a href="paso_final?url='.$url_clean .'">'.$url_clean .'</a>'.'======<a href="'.$url_clean .'">Click To link</a>' ;
                
            } catch (Exception $e) {
            
            } 
    }

    $link .= $link_clear .'<br>' ;
    $final  = substr($final,$i+$end);
}
  
    $final = str_replace('/ver','page.php?url=/ver',$link);
    $final = str_replace('/anime','interna.php?url=/anime',$final);

echo $final;

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>

<br>
<a href="<?php echo  $_REQUEST['back'] ?>">atrás</a>
    

    
