<?php 

require_once('./include.php');

$html_anime = file_get_contents('https://animeflv.net'.$_REQUEST['url']) ;


// Zippyshare -> no se pudo
// Sacar los iframe
$html_anime_iframe = $html_anime;
$html_anime_iframe =  $AnimeFlv->getTags($html_anime_iframe,'<iframe','</iframe>');

if (!empty($html_anime)) {
    $AnimeFlv->markerView($_REQUEST['url']);  
}
// $AnimeFlv->debug =1;

$final = $AnimeFlv->removeScript($html_anime);

$descargas_url = $AnimeFlv->getTags($final,'<table','</table>');
$descargas_url =  $AnimeFlv->getTags($descargas_url,'<a','</a>');


$final = $AnimeFlv->removeScript($final,'<table','</table>');
$AnimeFlv->chage_url = 1;
$final =  $AnimeFlv->getTags($final,'<a','</a>');
// echo $html_anime_iframe;

// Descripción del article (Next , prev, etc)
echo $final;

// <!-- Videosdisponibles -->
$AnimeFlv->startIframe($html_anime_iframe);
?>
<!-- Temporalmente cerrado -->
<button onclick="initShowDivOne(event)" class=" btn-success">Click Me to View Descargas</button>
 <div id="ShowOne"> 
<?php
//  Descargas -->
echo $descargas_url;
?>  
</div> 
 <?php


// <!-- Iframes -->
?>
<!-- <button onclick="initShowDivTwo(event)" class=" btn-success">Click Me to View Iframes</button>
 <div id="ShowTwo"> 
<?php
// $AnimeFlv->echoIframe();
?> 
 </div>    -->

<a href="./desactive.anime.php?url=<?php echo $_REQUEST['url'] ?>" class=" btn-danger" >Desactive Anime List</a>

 <script>

initShowDivOne(null);
initShowDivTwo(null);

     function initShowDivOne(event) {
         if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("ShowOne");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

     function initShowDivTwo(event) {
         if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("ShowTwo");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

   </script>

<?php
// <!--
require_once('./footer.php');
?>
