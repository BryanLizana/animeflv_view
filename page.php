<?php 


require_once('./include.php');



$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
// Zippyshare
// Sacar los iframe
$html_anime_iframe = $html_anime;
$endf = true;

for ($i=0; $i < 10 ; $i++) { 
    $if = strpos($html_anime_iframe,'<iframe');
    $iframe_string = substr($html_anime_iframe,$if);
    $endf = strpos($iframe_string,"</iframe>");
    $iframe_string  = substr($html_anime_iframe,$if,$endf + 9 );

    $iframe[] =$iframe_string;
    $html_anime_iframe  =str_replace( $iframe_string,'', $html_anime_iframe);
}
 


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
                $link_clear = '<a href="'.$url_clean .'">'.$url_clean .'</a>'.'======<a href="'.$url_clean .'" target="__black">Click To link</a>' ;                
            } catch (Exception $e) {
            
            } 
    }

    $link .= $link_clear .'<br>' ;
    $final  = substr($final,$i+$end);
}
  
$final = str_replace('/ver/','page.php?url=/ver/',$link);
$final = str_replace('/anime/','interna.php?url=/anime/',$final);

echo $final;

foreach ($iframe as $row) {
   echo $row;
}

// echo '<pre>'; var_dump( ($final) ); echo '</pre>'; die;/***HERE***/ 
?>


