<?php 

class AnimeFlv 
{

    public $debug = 0;
    public $text_full ;
    public $echo_resto_iframe = array();
    public $chage_url = 1;
    
    public function removeScript($text_full,$text_before="<script",$text_after="</script>",$menosSiTiene = "Palabra A coincidir que irá al final")
    {        
        $text_full_bu = $text_full;
        $i= true;
        $scrip_extra_valid = "";
        while ($i ) {
            $i = strpos($text_full,$text_before);
            $string_final = substr($text_full,$i);
            $end = strpos($string_final,$text_after);
           if ($i) {
            $link_clear = substr($text_full,$i,($end + strlen($text_after))); //substr ini and cuanto recorrerá apartir de ahí
            if (strpos($link_clear,$menosSiTiene)) {
                $scrip_extra_valid = $link_clear;
            }
            $text_full =  str_replace($link_clear,"",$text_full); 
        } 
        } 
    
        if (empty($text_full)) {
            $text_full = $text_full_bu;
        }
        return $text_full . $scrip_extra_valid;
    }


    public function getTags($text_full,$taginit,$tagend,$tag_final="<br>",$mode='entero')
    {
    
        $inicio = true;
        $restoGroup = "";

        if ($mode == 'entero') {
            $mas_inixio = 0;
            $mas_finx = strlen($tagend);
        }else {
            $mas_inixio = strlen($taginit);
            $mas_finx = 0;
        }
            while ($inicio ) {
                $inicio = strpos($text_full,$taginit);                
                $text_trozo = substr($text_full,$inicio + $mas_inixio );                            
                $fin = strpos($text_trozo,$tagend);
              
                if ($inicio) {
                        $resto = substr($text_full,$inicio + $mas_inixio,($fin + $mas_finx));
                        if (strpos($resto,'<img')) {
                            $resto = self::removeScript($resto ,'<figure>','</figure>');
                        }
            
                        if (strpos($resto,'http://ouo.io/s/y0d65LCP?s=') && $taginit == "<a") {
                            try {
                                $a = new SimpleXMLElement($resto);
                                $url_clean = str_replace('http://ouo.io/s/y0d65LCP?s=' , '',$a['href']);
                                $url_clean = urldecode($url_clean);                
                                $resto = '<a href="'.$url_clean .'"  target="__black">'.$url_clean .'</a>' ;                
                            } catch (Exception $e) {
                                $resto = json_encode( $e );
                            } 
                        }
            
                            // Negar si el tag tiene
                            $no_excluido = true;
                            foreach (array('contraseña','Inicio','Registrate','INICIAR SESION','Directorio Anime','Opción',
                                            'AnimeFLV','Cuevana','Términos y Condiciones','Politica y Privacidad','Política de Privacidad',
                                            'REPORTAR</span>','Estrellas','BtnNw','uploads/avatars/','animeflv/img/chat.png','FACEBOOK','TWITTER','Mas','aria-label="Close','class="fa-youtube"') as  $value) {
                                if (strpos($resto,$value)) {
                                    $no_excluido =  false;
                                    break;
                                }
                            }
            
                            if ($no_excluido)  $restoGroup .= $resto .$tag_final ;
                                                            
                        $text_full  = substr($text_full,$inicio+($fin + $mas_finx));                                                       
                }
            }
    
            if (!empty($restoGroup)) {
    
                if ($this->chage_url == 1 ) {
                     // Recrear url's
                    $restoGroup = str_replace('/ver/','page.php?url=/ver/',$restoGroup);
                    $restoGroup = str_replace('/browse/','search.php?',$restoGroup);
                    $restoGroup = str_replace('/anime/','interna.php?url=/anime/',$restoGroup);
                    $restoGroup = str_replace('/browse?','search.php?',$restoGroup);
                    $restoGroup = str_replace('<article class="Anime alt B">','',$restoGroup);
                    $this->chage_url = 0;
                }
               
                
                return $restoGroup;
            }else {
                return $text_full;
                
            }
    
    }


    public function startIframe($text_full)
    {
        $this->debug=1;
        $resto = self::getTags($text_full,'src="','"','','only');
        $resto = explode('http',$resto);
        foreach ($resto as  $value) {            
            $url = 'http' . $value;
            if (strpos($url,'efire.php')) {// Mediafire
                 self::getUrlMediafire($url);              
            }else if(strpos($url,'server=rv')) {//RV
                self::getUrlServerRV($url);
            }else if(strpos($url,'server=mega')) {//Mega
                self::getUrlServerMega($url);
            }else if(strpos($url,'server=streamango')) {//Manho - Se mantiene la publicidad :/
                // Muy complicado xd
            }elseif (!empty($value)) {
                $this->echo_resto_iframe[] = $url;
            }           
        }

     
    }

    public function getUrlMediafire($url)
    {
        // efire.php
        if ( isset($url)) {
            $html_anime = file_get_contents($url) ;
            $final = self::removeScript($html_anime,'<script','</script>','https://www.mediafire.com/');        
          
            $resto = self::getTags($final,"<script",'</script>');
            $resto = str_replace("$(window).width()",'"95%"', $resto);
            $resto = str_replace("$(window).height()",'"95%"', $resto);
          ?> 

        <div>
            <div id="message"></div>
            <div id="videoLoading"></div>
            <div id="player"></div>
            <div id="my-player"></div>
            <!-- <input type="button" id="start" value="START"> -->
            <button type="button" id="start" class=" btn-success" >START VIDEO MediaFire</button>
        </div>
            <?php
            $resto = str_replace('}).fail(function()','XXXXXXXXXX } }).fail(function()', $resto );
            $resto =  self::removeScript($resto,"var player","XXXXXXXXXX");            
            echo $resto; //script mediafire
        } 
    }

    public function getUrlServerRV($url)
    {
        if ( isset($url)) {
            $html_anime = file_get_contents($url) ;
            $final = self::removeScript(self::removeScript($html_anime,'<noscript','</noscript>'),'<script','</script>','window.location.href');          
            $resto = str_replace(' ','',$final);  
            $resto = self::getTags($resto,'window.location.href="','";','<br>','only');
            $resto =  explode('<br>',$resto);
            $resto = $resto[0] .'para_que_muestre_tres_resoluciones';

            $html_anime = file_get_contents( trim($resto)) ;
            $video = self::getTags($html_anime,"<video",'</video>');
            $video = self::getTags($video,'src="','"','<br>','only');
            $video = explode('<br>',$video);
            echo '<hr>';
            foreach ($video as $url_video) {
                if (strpos($url_video,'ttp')) {
                    echo '<a href="'.$url_video.'" target="__black">VIEW VIDEO RV </a><br>';                   
                }
            }
            echo '<hr>';

        } 

    }

    public function getUrlServerMega($url)
    {
        if ( isset($url)) {
            $html_anime = file_get_contents($url) ;
            $final = self::removeScript($html_anime,'<script','</script>','window.location.href');          
            $resto = str_replace(' ','',$final);  
            $resto = self::getTags($resto,'window.location.href="','";','<br>','only');
            $resto =  explode('<br>',$resto);
            $resto = $resto[0] ;

            if (strpos($resto,'mega')) {
                echo '<a href="'.$resto.'" target="__black">VIEW VIDEO  MEGA </a><br>';                   
            }
            echo '<hr>';

        } 
    }

    public function echoIframe()
    {
      foreach ($this->echo_resto_iframe as  $value) {
           echo '<iframe width="560" height="315" src="'.$value.'" frameborder="0" allowfullscreen></iframe> <hr>'."\n";
      }
    }


    public function viewViews()
    {
        $views = file_get_contents('./json/view.json');
        $views = json_decode($views);
        foreach ($views as $v) {     
           echo '<a href="page.php?url='.$v.'">'.$v.'</a><br>';
        }
    }
    
    public function markerView($urlView)
    {

        $urlView = array($urlView );

        $viewsAll = array('Links');

        $views = file_get_contents(__DIR__.'/json/view.json');
        $views = json_decode($views,true);
        if (!is_array($views)) {
            $viewsAll = array_merge($viewsAll,$urlView);
        }else{
            $viewsAll = array_merge($viewsAll,$views,$urlView);

        }

        try {
            $viewsAll = array_unique($viewsAll);

            if (count($viewsAll) < 10) {
                $myfile = fopen(__DIR__."/json/view.json", 'w+') or die('nop');
                $txt = json_encode( $viewsAll );
                fwrite($myfile, $txt);
                fclose($myfile);
            }
            
        } catch (Exception $e) {
         $e->getMessage() ;
         echo '<pre>'; var_dump( $e->getMessage() ); echo '</pre>'; die;/***HERE***/ 
        } 
       

    }
    
    
}
