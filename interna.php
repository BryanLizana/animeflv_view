<?php 
require_once('./include.php');

$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;
$final = $AnimeFlv->removeScript($html_anime,'<script','</script>','episodes');
$final_script =  $AnimeFlv->getTags($final,'<script','</script>');
$final =  $AnimeFlv->getTags($final,'<a','</a>');
echo $final;
echo $final_script;

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
require_once('./footer.php');
?>
