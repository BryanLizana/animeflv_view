
<?php 

require_once('./include.php');
$html_anime = file_get_contents('https://animeflv.net/') ;
$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>');
$final =  $AnimeFlv->getTags($final,'<a','</a>');

$final = str_replace('/uploads/','https://animeflv.net/uploads/',$final);
$final = str_replace('<a href="#" class="Active">','',$final);


$final = str_replace('EN EMISION','EN EMISION <br><button onclick="myFunctionEmision(event)" class=" btn-success">Click Me to View Emision</button>',$final);
$final = str_replace('class="Bod ScrlV Fl"','id="emision"',$final);

$final = str_replace('HOY','</div></li>HOY <br><button onclick="nextBoxHiden(event)" class=" btn-success">Click Me to View Hoy Episodes</button><li><div class="box">',$final);
echo $final.'</div></li>';

 ?>
 <div></div>
   <script>

myFunctionEmision(null);
nextBoxHiden(null);
     function myFunctionEmision(event) {
         if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("emision");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }



    function nextBoxHiden(event) {
        if(event != null){
            event.preventDefault()
         }

        const togglers = document.querySelectorAll('.box');
        togglers.forEach(function(el) {
            if (el.style.display === "none") {
                el.style.display = "block";
            } else {
                el.style.display = "none";
            }
            throw new TypeError();
        });
        }
       
   </script>
<?php
require_once('./footer.php');
?>
