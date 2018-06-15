
<?php 

require_once('./include.php');
$html_anime = file_get_contents('https://animeflv.net/') ;
$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>');
$final =  $AnimeFlv->getTags($final,'<a','</a>');

$final = str_replace('/uploads/','https://animeflv.net/uploads/',$final);


// $final = str_replace('EN EMISION','EN EMISION <button onclick="myFunctionEmision(event)">Click Me to View Emision</button>',$final);
// $final = str_replace('class="Bod ScrlV Fl"','id="emision"',$final);


// $final = str_replace('HOY','</div></li>HOY <button onclick="myFunction(event)">Click Me to View Today</button><li id="myDIV">',$final);
echo $final.'</li>';

 ?>
 <!-- <div></div>
   <script>

myFunctionEmision(null);
myFunction(null);
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

    function myFunction(event) {
        if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
   </script> -->
<?php

?>
