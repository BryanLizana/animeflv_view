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

?> 
<!-- https://animeflv.net/browse?q=naruto -->
<form action="search.php" method="get" >
<input type="text" name="q" id="" placeholder="buscar">
</form>
<br>
<?php

  ?>