<?php 
class AnimeFlv 
{

    
    public function removeScript($text_full,$text_before="<script",$text_after="</script>",$menosSiTiene = "Palabra A coincidir que irá al final")
    {        
        $text_full_bu = $text_full;
        $end= true;
        $scrip_extra_valid = "";
        while ($end ) {
            $i = strpos($text_full,$text_before);
            $string_final = substr($text_full,$i);
            $end = strpos($string_final,$text_after);
            $link_clear = substr($text_full,$i,($end + strlen($text_after))); //substr ini and cuanto recorrerá apartir de ahí
            
            if (strpos($link_clear,$menosSiTiene)) {
                $scrip_extra_valid = $link_clear;
            }
            
            $text_full =  str_replace($link_clear,"",$text_full); 
        } 
    
        if (empty($text_full)) {
            $text_full = $text_full_bu;
        }
        return $text_full . $scrip_extra_valid;
    }


    public function getTags($text_full,$taginit,$tagend)
    {
    
        $fin = true;
        $restoGroup = "";
            while ($fin ) {
                $inicio = strpos($text_full,$taginit);
                $text_trozo = substr($text_full,$inicio);
                $fin = strpos($text_trozo,$tagend);
                $resto = substr($text_full,$inicio,($fin + strlen($tagend)));
                if (strpos($resto,'<img')) {
                    // try {
                    //     $ii = strpos($link_clear,'<img');
                    //     $link_clear_img = substr($link_clear,$ii);
                    //     $endi = strpos($link_clear_img,">");
                    //     $link_clear_img = substr($link_clear,$ii,$endi + 1);
                    //    echo '<pre>'; var_dump( $link_clear_img ); echo '</pre>'; die;/***HERE***/ 
                    //     $link_clear = $link_clear_img ;             
                    //  } catch (Exception $e) {         
                    //  } 
                }
    
                if (strpos($resto,'http://ouo.io/s/y0d65LCP?s=')) {
                    try {
                        $a = new SimpleXMLElement($resto);
                        $url_clean = str_replace('http://ouo.io/s/y0d65LCP?s=' , '',$a['href']);
                        $url_clean = urldecode($url_clean);                
                        $resto = '<a href="'.$url_clean .'">'.$url_clean .'</a>'.'======<a href="'.$url_clean .'" target="__black">Click To link</a>' ;                
                    } catch (Exception $e) {
                        $resto = json_encode( $e );
                    } 
                }
    
                $restoGroup .= $resto .'<br>' ;
                $text_full  = substr($text_full,$inicio+($fin + strlen($tagend)));
            }
    
            if (!empty($restoGroup)) {
    
                // Recrear url's
                $restoGroup = str_replace('/ver/','page.php?url=/ver/',$restoGroup);
                $restoGroup = str_replace('/browse/','search.php?',$restoGroup);
                $restoGroup = str_replace('/anime/','interna.php?url=/anime/',$restoGroup);
                $restoGroup = str_replace('/uploads/','https://animeflv.net/uploads/',$restoGroup);
                $restoGroup = str_replace('/browse?','search.php?',$restoGroup);
                
                return $restoGroup;
            }else {
                return $text_full;
                
            }
    
    }

    public function getUrlMediafire($text_full)
    {
        // efire.php
        $resto = self::getTags($text_full,"src=",'" ');

        $resto =  str_replace(' ','',$resto);
        $resto =  str_replace('src="','',$resto);
        $resto =  str_replace('allowfullscreen','',$resto);
        $resto =  str_replace('"','',$resto);
        $resto =  str_replace('<br>','',$resto);
        $resto = explode('http',$resto);

        foreach ($resto as  $value) {
            if (strpos($value,'efire.php')) {
            $value_url =  'http' . $value;               
            }
        }
        if ( isset($value_url)) {
            $html_anime = file_get_contents($value_url) ;
            $final = self::removeScript(self::removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>','https://www.mediafire.com/');        
          
            $resto = self::getTags($final,"<script",'</script>');

            $resto = str_replace("$(window).width()",'"90%"', $resto);
            $resto = str_replace("$(window).height()",'"90%"', $resto);
          ?> 
            <div id="message"></div>
            <div id="videoLoading"></div>
            <div id="player"></div>
            <div id="my-player"></div>
            <input type="button" id="start" value="START">
            <div id=""></div>
            
            <?php
           echo $resto;
        } 


    }

    public function getUrlServerRV($text_full)
    {
        $resto = self::getTags($text_full,"src=",'" ');

        $resto =  str_replace(' ','',$resto);
        $resto =  str_replace('src="','',$resto);
        $resto =  str_replace('allowfullscreen','',$resto);
        $resto =  str_replace('"','',$resto);
        $resto =  str_replace('<br>','',$resto);
        $resto = explode('http',$resto);

        foreach ($resto as  $value) {
            if (strpos($value,'server=rv')) {
            $value_url =  'http' . $value;               
            }
        }


        if ( isset($value_url)) {
            $html_anime = file_get_contents($value_url) ;
            $final = self::removeScript(self::removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>','window.location.href');          
            $resto = str_replace(' ','',$final);           
            $resto = self::getTags($resto,"window.location.href",'";');
            $resto = str_replace('window.location.href="','',$resto);
            $resto = str_replace(';','',$resto);
            $resto = str_replace('"','',$resto);

            $resto =  explode('https',$resto);
            $resto = 'https'.$resto[1];
            $html_anime = file_get_contents( trim($resto)) ;
            $video = self::getTags($html_anime,"<video",'</video>');
            $video = self::getTags($video,'src="','" ');

            $video = explode('<br>',$video);
            echo '<hr>';
            foreach ($video as $url_video) {
                $url_video =  str_replace('src=','',$url_video);
                $url_video =  str_replace('"','',$url_video);
                if (strpos($url_video,'ttp')) {
                    echo '<a href="'.$url_video.'" target="__black">VIEW VIDEO </a><br>';                   
                }
            }
            echo '<hr>';

        } 

    }
}
