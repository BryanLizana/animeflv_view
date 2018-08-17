<?php 

require_once('../acore/class.anime.php');
require_once('./templates/header.php');

$html_anime = classAnime::get_url_contents('https://animeflv.net'.$_REQUEST['url']);
// $html_anime_iframe = classAnime::getTag($html_anime,'<iframe','</iframe>');


$html_anime = classAnime::removeTag($html_anime,'<script','</script>');
$html_anime = classAnime::getTag($html_anime,'<table','</table>');
$html_anime = classAnime::getTag($html_anime,'<a','</a>');
$descargas_url = explode('<br>',$html_anime);
$descargas_url =  array_unique($descargas_url);
$descargas_url =  implode('',$descargas_url);

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

<?php 

$urlView  = $_REQUEST['url'];
$urlView_array = explode("/",$urlView);
        $view_anime_name = $urlView_array[count($urlView_array) -1 ];

        //get cap
        $cap = explode("-",$view_anime_name);
        $cap = $cap[count($cap) - 1];

        if (is_numeric($cap)) {
            $view_anime_name =  str_replace($cap,'',$view_anime_name);
            $view_anime_name =  ucwords(str_replace('-',' ',$view_anime_name));
            $view_anime_name =  trim($view_anime_name);
        }

        $urlView = array('name' => $view_anime_name,'cap' => $urlView ,'date'=> date('Y-m-d'),'number'=>$cap );

        $views = file_get_contents(__DIR__.'/json/view.json');
        $views = json_decode($views,true);
        if (!is_array($views)) {
            $viewsAll[] = $urlView;
        }else{     
            $push = true;

            for ($i=0; $i < count($views) ; $i++) { 
                if ($views[$i]['name'] == $urlView['name'] ) { //update cap
                    // TODO: Poner al final o principio, quitar y push array
                    $views[$i] = $urlView ;
                    $push = false;
                }
            }      
            if ( $push == true) {
                array_push($views,$urlView);
            }
            $viewsAll = $views; 
        }

        try {
            // $viewsAll = array_unique($viewsAll);

            if (count($viewsAll) < 100) {
                $myfile = fopen(__DIR__."/json/view.json", 'w+') or die('nop');
                $txt = json_encode( $viewsAll );
                fwrite($myfile, $txt);
                fclose($myfile);
            }
            
        } catch (Exception $e) {
         $e->getMessage() ;
         echo '<pre>'; var_dump( $e->getMessage() ); echo '</pre>'; die;/***HERE***/ 
        }
?>
