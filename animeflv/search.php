<?php 
require_once('../acore/class.anime.php');
require_once('./templates/header.php');



$url = str_replace(" ",'%20','https://animeflv.net/browse?'. http_build_query($_REQUEST) );

$html_anime = classAnime::get_url_contents($url);
$html_anime = classAnime::removeTag($html_anime,'<script','</script>');

$no =  array('Registrate','¿Olvidaste tu contraseña?','Inicio','Directorio Anime','FACEBOOK','TWITTER',' favoritos','<span>SEGUIR</span>','DEJAR DE',
            'Mas','AnimeFLV','Temas para Wordpress','Cuevana','Términos y Condiciones','Politica y Privacidad','Política de Privacidad');

$html_anime = classAnime::getTag($html_anime,'<a ','</a>',"<br> \n\r",'completo',$no);

$html_anime = str_replace('/ver/','page.php?url=/ver/',$html_anime);
$html_anime = str_replace('/browse?','search.php?',$html_anime);
$html_anime = str_replace('/anime/','interna.php?url=/anime/',$html_anime);
echo $html_anime;
?>

<?php 
require_once('./templates/footer.php');
?>