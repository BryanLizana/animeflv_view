<?php 
require_once('../acore/class.anime.php');
require_once('./templates/header.php');

$html_anime = classAnime::get_url_contents('https://animeflv.net'.$_REQUEST['url']);
$html_anime = classAnime::removeTag($html_anime,'<script','</script>','episodes');
$html_anime_script = classAnime::getTag($html_anime,'<script','</script>');

$no =  array('Registrate','¿Olvidaste tu contraseña?','Inicio','Directorio Anime','FACEBOOK','TWITTER',' favoritos','<span>SEGUIR</span>','DEJAR DE',
            'Mas','AnimeFLV','Temas para Wordpress','Cuevana','Términos y Condiciones','Politica y Privacidad','Política de Privacidad');

$html_anime = classAnime::getTag($html_anime,'<a ','</a>',"<br> \n\r",'completo',$no);
$html_anime = classAnime::removeTag($html_anime,'TEXTOBEFOREXXX','TEXTOAFTERXXX');

$html_anime = str_replace('/browse?','search.php?',$html_anime);

echo $html_anime;
echo $html_anime_script;

echo '<div id="episodeList"><div>'

?>
<script>
    
$(document).ready(function(){

    

appendEpisode = function(i, lazy) {

    lazy = typeof lazy !== 'undefined' ? lazy : true;

    let temp_episode = episodes[i];
    console.log(temp_episode[1]);

    $("#episodeList").append(
        '<a href="page.php?url=/ver/' + episodes[i][1] + '/' + anime_info[2] + '-' + episodes[i][0] + '">' +
        '<figure><img ' + (lazy ? ' class="lazy" data-src="' : ' src="') + 'https://animeflv.net/uploads/animes/screenshots/' + anime_info[0] + '/' + episodes[i][0] + '/th_3.jpg" alt=""></figure>' +
        '<h3 class="Title">' + anime_info[1] + 'Episodio ' + episodes[i][0] + '</h3>' +
        '</a>' );
};



for (var i = 0; i < (episodes.length); i++) {
    appendEpisode(i,episodes);
}


});
</script>
<?php 
require_once('./templates/footer.php');
?>
