<?php 
function converter_link(String $var = null)
{
    try {
        $a = new SimpleXMLElement($var);
       return  $a['href']; // will echo www.something.com
  
    } catch (Exception $e) {
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

    
$i = strpos($final,'Lista de episodios');

$string_final = substr($final,$i);
$end = strpos($string_final,"</section>");
echo str_replace('/ver','page?url=/ver',substr($final,$i,$end));

?>

<br>
<a href="<?php echo  $_REQUEST['back'] ?>">atrás</a>