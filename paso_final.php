<?php 



$html_anime = file_get_contents($_REQUEST['url']) ;
$final = str_replace( 'script','',$html_anime);
$end = true;

$ini = 0;
$link = "";

    $i = strpos($final,'[url=//');
    $string_final = substr($final,$i);
    $end = strpos($string_final,"[/url]");
    $link_clear = (substr($final,$i + 7,$end - 7));

$i = strpos($final,'%1000');
$string_final = substr($final,$i - 6);
// https://www112.zippyshare.com/d/nGinuf6V/75/7_833.mp4
$time = substr($string_final ,0, 6 );

$time = ($time % 1000 ) + 11;
$ar = explode('file.html]',$link_clear);
$url = 'https://'.str_replace('/v/','/d/',$ar[0]) .$time .'/'.$ar[1] ;
$direccion=$url; 
echo '<pre>'; var_dump( $url ); echo '</pre>'; die;/***HERE***/ 
// header("Content-disposition: attachment; filename=".$ar[1]);
// header("Content-type: MIME");
//             $direccion=str_replace(" ","%20",$direccion); 
//             $existe=@fopen($direccion,'r'); 
//             if ($existe){ 
//             echo "<font face='Verdana' size='2' color='#00FF00'>EXISTE</font>"; 
//             fclose($existe);
//             readfile($direccion);

//             }else{ 
//              echo "<font face='Verdana' size='2' color='#FF0000'>EXISTE</font>"; 
//             }  
// echo $link_clear;

?>