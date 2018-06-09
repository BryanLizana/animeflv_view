<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <form action="" method="post">
  

    <input type="text" name="siteother" id="" placeholder="site url"> <br>
    <input type="text" name="" id=""> <br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>

<?php  if(isset($_REQUEST['siteother'])):  ?>
  
<?php 
// No se puede :(
$url_home = '';
require_once('./include.php');
 
$html_anime = file_get_contents($_REQUEST['siteother']) ;
// $final = $html_anime;
$final = removeScript(removeScript($html_anime),'<noscript','</noscript>');


$final = str_replace('href="'.$url_home,'href="other.php?siteother='.$url_home,$final);
$final = str_replace('http://ouo.io/s/lbH3iXRW?s=','',$final);

echo $final;


?>

<?php  endif;  ?>
