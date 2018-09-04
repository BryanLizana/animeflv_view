<?php  
require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://www1.gogoanime.sh');
  
$html_anime = classAnime::getTag($html_anime,'<ul','</ul>',"<br> \n\r",'completo',$no);

// Remplaces:

$html_anime = str_replace('="/img','="https://www1.gogoanime.sh/img',$html_anime);

$html_anime = str_replace('"/category','"category.php?url=/category',$html_anime);
$html_anime = str_replace('"/genre','"category.php?url=/genre',$html_anime);
$html_anime = str_replace('"/','"page.php?url=/',$html_anime);


echo $html_anime;

?>
   <style lang="">
       .img img{
            max-width: 200px;
       }
   </style>