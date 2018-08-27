<?php 

require_once('../acore/class.anime.php');
require_once('./templates/header.php');

$html_anime = classAnime::get_url_contents('https://animeflv.net'.$_REQUEST['url']);

$html_anime_iframe = classAnime::getTag($html_anime,'<iframe','</iframe>');

$html_anime = classAnime::removeTag($html_anime,'<script','</script>');

$next = classAnime::getTag($html_anime,'<a href="/ver/','SIGUIENTE</a>',null,'completo',null,true);

if ($next == '<a href="/ver') {
$next = classAnime::getTag($html_anime,'<a href="/ver/','ANTERIOR</a>',null,'completo',null,true);    
}

$html_anime = classAnime::getTag($html_anime,'<table','</table>');
$html_anime = classAnime::getTag($html_anime,'<a','</a>');
$descargas_url = explode('<br>',$html_anime);
$descargas_url =  array_unique($descargas_url);
$descargas_url =  implode('',$descargas_url);


$html_anime = classAnime::startIframe($html_anime_iframe);
echo $next;
echo $html_anime;
?>
<!-- Temporalmente cerrado -->
<button onclick="initShowDivOne(event)" class=" btn-success">Click Me to View Descargas</button>
 <div id="ShowOne"> 
<?php
//  Descargas -->
echo $descargas_url;
?>  
</div> 

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
require_once('./templates/footer.php');
?>
