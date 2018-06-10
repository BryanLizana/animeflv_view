<?php 

function removeScript($text_full,$text_before="<script",$text_after="</script>")
{
    // <script
    // </script>
    $text_full_bu = $text_full;
    $end= true;
    while ($end ) {
    
        $i = strpos($text_full,$text_before);
        $string_final = substr($text_full,$i);
        $end = strpos($string_final,$text_after);
        $link_clear = substr($text_full,$i,($end ));
        $text_full =  str_replace($link_clear,"",$text_full);

        

    } 
    $text_full =  str_replace($text_after,"",$text_full);

    if (empty($text_full)) {
        $text_full = $text_full_bu;
    }
    return $text_full;

}

?> 
<!-- https://animeflv.net/browse?q=naruto -->
<!-- <form action="search.php" method="get" >
<input type="text" name="q" id="" placeholder="buscar" value="<?php echo $_REQUEST['q'] ?>">
</form> -->
<a href="https://animeflv.net<?php echo $_GET['url'] ?>" target="__black">VIEW PAGE ANIMEFLV</a>
<br>
<form action="search.php" method="get">
<input name="q" type="text" id="search-anime" autocomplete="off" placeholder="Buscar..." value="<?php echo $_REQUEST['q'] ?>">
<button><i class="fa-search">Buscar</i></button>
</form>
<div class="DpdwCnt TtCn">
<ul class="ListResult"></ul>
</div>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.typewatch.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<?php

  ?>