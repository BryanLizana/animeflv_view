<?php 

require_once('../acore/class.anime.php');
require_once('./templates/header.php');


classAnime::markerView($_REQUEST['url']);

$html_anime = classAnime::get_url_contents('https://animeflv.net'.$_REQUEST['url']);

// $html_anime_iframe = classAnime::getTag($html_anime,'<iframe','<\/iframe>');

// $html_anime_iframe =  str_replace('\/','/',$html_anime_iframe);
// $html_anime_iframe =  str_replace('\"','"',$html_anime_iframe);

// $array_iframe =  explode('XXXXXXXXOOO',$html_anime_iframe);
// echo '<pre>'; var_dump( json_decode($array_iframe[0],true) ); echo '</pre>'; die;/***HERE***/ 
// echo '<pre>'; var_dump( $html_anime_iframe ); echo '</pre>'; die;/***HERE***/ 
$html_anime = classAnime::removeTag($html_anime,'<script','</script>');



// if (strpos($html_anime,'a href="/ver') &&  (strpos($html_anime,'SIGUIENTE') ||  strpos($html_anime,'ANTERIOR')   )) {
//     $next = classAnime::getTag($html_anime,'<a href="/ver/','SIGUIENTE</a>',null,'completo',null,true);
//     if ($next == '<a href="/ver') {
//         $next = classAnime::getTag($html_anime,'<a href="/ver/','ANTERIOR</a>',null,'completo',null,true);    
//     }
// }

$html_anime = classAnime::getTag($html_anime,'<table','</table>');
$html_anime = classAnime::getTag($html_anime,'<a','</a>');
$descargas_url = explode('<br>',$html_anime);
$descargas_url =  array_unique($descargas_url);
$descargas_url =  implode('',$descargas_url);


// $html_anime = classAnime::startIframe($html_anime_iframe);

// $next = str_replace('/ver/','page.php?url=/ver/',$next);
// $next = str_replace('/browse','#',$next);
// $next = str_replace('/anime/','interna.php?url=/anime/',$next);

// echo $next;
// echo $html_anime;
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

<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.1&appId=1730508916998105&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
</script>
<div class="WdgtCn">
    <div class="Top">
        <div class="Title">Comentarios</div>
    </div>
    <div class="fb-comments" data-href="https://animeflv.net<?php echo $_GET['url'] ?>" style="width:100%;" width="100%" data-numposts="20"></div>
</div>


<?php 
require_once('./templates/footer.php');
?>
