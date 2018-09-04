

<?php  
echo  '<a href="index.php">Home</a><br><br><br>';

require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://www1.gogoanime.sh//search.html?keyword='.$_REQUEST['keyword'].'&page='.$_REQUEST['page'].'');
// $no = array('Login','Sign up');
$html_anime = classAnime::getTag($html_anime,'<ul','</ul>',"<br> \n\r",'completo',$no);
$html_anime = classAnime::removeTag($html_anime,'TEXTOBEFOREXXX','TEXTOAFTERXXX');

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