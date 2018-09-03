<?php 
require_once('../acore/class.anime.php');
require_once('./templates/header.php');

$html_anime = classAnime::get_url_contents('https://animeflv.net/');
$html_anime = classAnime::removeTag($html_anime,'<img','>');

$no =  array('Directorio Anime','Temas para Wordpress','Cuevana','Términos y Condiciones','Politica y Privacidad','Política de Privacidad',
            'AnimeFLV');

$html_anime = classAnime::getTag($html_anime,'<a ','</a>',"<br> \n\r",'completo',$no);
$html_anime = classAnime::removeTag($html_anime,'TEXTOBEFOREXXX','TEXTOAFTERXXX');



$html_anime = str_replace('/ver/','page.php?url=/ver/',$html_anime);
$html_anime = str_replace('/browse','#',$html_anime);
$html_anime = str_replace('/anime/','interna.php?url=/anime/',$html_anime);

$html_anime_array_a = explode('<br>',$html_anime);

$onlyOne= true;
for ($i=0; $i < count($html_anime_array_a) ; $i++) { 
    if (strpos($html_anime_array_a[$i],"VER ANIME") && $onlyOne) {
        $html_anime_array_a[$i - 1] =  "XXXXXXXXXXXX" .  $html_anime_array_a[$i - 1] ;
        $onlyOne= false;        
    }

    if (strpos($html_anime_array_a[$i],"HOY")) {
        $html_anime_array_a[$i] =  "XXXXXXXXXXXX" .  $html_anime_array_a[$i] ;        
    }
    
}

$html_anime_array_a =  implode('<br>',$html_anime_array_a);
$html_anime_array_a =  explode('XXXXXXXXXXXX',$html_anime_array_a);

$i = 1;
foreach ($html_anime_array_a as $html_anime) {
    if (!empty($html_anime) && $i > 1 ) {
        echo '<button onclick="ShowBox'.$i.'(event)" class=" btn-success">Click Me to View '.$array_name[$i].'</button>';
        echo '<div id="box'.$i.'">';   
        echo $html_anime;
        echo '</div>';
    }
    $i++;

}

?>

<script>

    ShowBox2(null);
    ShowBox3(null);

    function ShowBox2(event) {
         if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("box2");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function ShowBox3(event) {
         if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("box3");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
       
   </script>

    <?php 

    $views = file_get_contents('./json/view.json');
    $views = json_decode($views);
    foreach ($views as  $value) {   
    echo '<a href="page.php?url='.$value->cap.'">'.$value->name.' - '.$value->number.' - '.$value->date.'</a><br>';
    }

    ?>

    <?php 
    require_once('./templates/footer.php');
    ?>