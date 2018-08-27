<?php 
if (!empty($_REQUEST['url_jk'])) {

    require_once('../acore/class.anime.php');

    $html_anime = classAnime::get_url_contents($_REQUEST['url_jk']);
    $html_anime = classAnime::getTag($html_anime,'<iframe','</iframe>');
    $html_anime = classAnime::getTag($html_anime,'src="','"','<br>','single');
    $html_anime =  explode('<br>',$html_anime);

    foreach ($html_anime as $value) {
        if (strpos($value,'u=stream')) {
             $content_value = classAnime::get_url_contents($value);
             $urls = classAnime::getTag($content_value,'&file=','"','<br>','single');

            echo $urls;
            $var = explode("<br>",$urls);

            foreach ($var as $value) {
                ?>
                 <video src="<?php echo  $value ?>" autoplay></video>  
                <?php
            }
            echo '<hr>';
        }else if(!strpos($value,'www.facebook.com')) {
            
         echo $value . "\n <hr>";
        }
    }

}