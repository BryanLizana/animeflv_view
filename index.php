
<?php 
require_once('./include.php');
$html_anime = file_get_contents('https://animeflv.net/') ;

$AnimeFlv->viewViews();

$final = $AnimeFlv->removeScript($AnimeFlv->removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>');
$final =  $AnimeFlv->getTags($final,'<a','</a>','');

$final = str_replace('/uploads/','https://animeflv.net/uploads/',$final);
$final = str_replace('<a href="#" class="Active">','',$final);

$final = str_replace('HOY','</li>HOY<li>',$final);
$final =  $final.'</li>';
$final =  $AnimeFlv->getTags($final,'<li>','</li>','SEPAREBR');

$final =  explode('SEPAREBR',$final);
$i = 1;
$array_name = ['null','Emision','Episodios Hoy','Series Hoy'];
foreach ($final as $value) {
    if (!empty($value)) {
        echo '<button onclick="ShowBox'.$i.'(event)" class=" btn-success">Click Me to View '.$array_name[$i].'</button>';
        echo '<div id="box'.$i.'">';   
        echo $value;
        echo '</div>';
        $i++;
    }
}
?>

<script>

ShowBox1(null);
ShowBox2(null);
ShowBox3(null);

     function ShowBox1(event) {
         if(event != null){
            event.preventDefault()
         }
            var x = document.getElementById("box1");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

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


    // function nextBoxHiden(event) {
    //     if(event != null){
    //         event.preventDefault()
    //      }

    //     const togglers = document.querySelectorAll('.box');
    //     togglers.forEach(function(el) {
    //         if (el.style.display === "none") {
    //             el.style.display = "block";
    //         } else {
    //             el.style.display = "none";
    //         }
    //         throw new TypeError();
    //     });
    //     }
       
   </script>
<?php
require_once('./footer.php');
?>
