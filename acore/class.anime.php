<?php 

class classAnime 
{
    public $textohtml;
    
    static function get_url_contents($url) {
        $crl = curl_init();
    
        curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);
    
        $response = curl_exec($crl);
        curl_close($crl);
        return $response;
    }

    static function removeTag($textohtml,$text_before,$text_after = false,$menosSiTieneThisWord = false)
    {        

        $textohtml = " ".$textohtml." ";
        $textohtml_backup = $textohtml;            
        $i= true; //mientras text_before_exist
        $contador_break = 0;
        if (!$text_after || empty($text_after)) {
            $text_after = str_replace('<','</',$text_before);
        }

        
        while ($i) {           
            $textohtml_resto_init = strpos($textohtml,$text_before); //mientras text_before_exist
           
            // para evitar que el text_after sea el próximo tag y no uno anterior (Para los casos de " o />)
            $textohtml_para_text_after = substr($textohtml,$textohtml_resto_init ); //texto a remover

            $textohtml_resto_end = strpos($textohtml_para_text_after,$text_after);

           if ($textohtml_resto_init) {

                $textohtml_resto = substr($textohtml,$textohtml_resto_init,($textohtml_resto_end + strlen($text_after) ) ); //texto a remover

                $remplazar = true;
                if ($menosSiTieneThisWord) {
                    if (is_array($menosSiTieneThisWord)) {
                       foreach ($menosSiTieneThisWord as $value) {
                            if (strpos($textohtml_resto,$value)) {
                                 $remplazar = false;
                                 break;
                            }     
                       }
                    }else if (strpos($textohtml_resto,$menosSiTieneThisWord)) {
                        $remplazar = false;
                    }                      
                }
                   
                if ($remplazar) {
                    $textohtml =  str_replace($textohtml_resto,"",$textohtml);                    
                }else {   

                    $textohtml_resto_not_remove = str_replace($text_before,"TEXTOBEFOREXXX",$textohtml_resto);
                    $textohtml_resto_not_remove = str_replace($text_after,"TEXTOAFTERXXX",$textohtml_resto_not_remove);
                    $textohtml =  str_replace($textohtml_resto,$textohtml_resto_not_remove,$textohtml);  
                    $reparar_luego =  true;
                }
            } 

            $i =  $textohtml_resto_init;

            $contador_break++;
            
            if ($contador_break == 10000) {
                echo '<pre>'; var_dump( 'Ey, here it is a trouble' ); echo '</pre>'; die; /***HERE***/
            }
            
        }    

        if (isset($reparar_luego) && $reparar_luego) {
            $textohtml = str_replace("TEXTOBEFOREXXX",$text_before,$textohtml);
            $textohtml = str_replace("TEXTOAFTERXXX",$text_after,$textohtml);
        }

        return $textohtml;
    }

    public function getTag($textohtml,$text_before,$text_after = false,$tagUnidor= "<br> \n\r", $mode = 'completo', $menosSiTieneThisWord = false,$debug =  false)
    {

        $textohtml = " ".$textohtml." ";

        if (strpos($textohtml,'figure>')) {
            $textohtml = self::removeTag($textohtml,'<figure>','</figure>');
        }
    
        $textohtml_backup = $textohtml;            
        $i= true; //mientras text_before_exist
        $contador_break = 0;
        if (!$text_after || empty($text_after)) {
            $text_after = str_replace('<','</',$text_before);
        }

        if ($mode == 'completo') {
            $mas_inixio = 0;
            $mas_finx = 0;
        }else {
            $mas_inixio = strlen($text_before);
            $mas_finx = strlen($text_after);
        }

        while ($i) {
            $textohtml_resto_init = strpos($textohtml,$text_before); //mientras text_before_exist
            // para evitar que el text_after sea el próximo tag y no uno anterior (Para los casos de " o />)
            $textohtml_para_text_after = substr($textohtml,$textohtml_resto_init + $mas_inixio ); //texto a remover
            $textohtml_resto_end = strpos($textohtml_para_text_after,$text_after);
            
           if ($textohtml_resto_init) {            
                //$textohtml_resto = substr($textohtml,$textohtml_resto_init,($textohtml_resto_end + strlen($text_after)) -  $textohtml_resto_init ); //texto a remover
                $textohtml_resto = substr($textohtml,$textohtml_resto_init + $mas_inixio ,($textohtml_resto_end + strlen($text_after) ) - $mas_finx ); //texto a remover                
                $textohtml_resto_alternative = substr($textohtml,$textohtml_resto_init ,($textohtml_resto_end + strlen($text_after) )   ); //texto a remover                
                $addtexthtml = true;

                if ($menosSiTieneThisWord) {
                    if (is_array($menosSiTieneThisWord)) {
                       foreach ($menosSiTieneThisWord as $value) {
                            if (strpos($textohtml_resto,$value)) {
                                $addtexthtml = false;
                                break;
                            }
                       }

                    }else if (strpos($textohtml_resto,$menosSiTieneThisWord)) {
                        $addtexthtml = false;
                    }               
                }
                   
                if ($addtexthtml) {    
                    $textohtml =  str_replace($textohtml_resto_alternative,"",$textohtml);
                    
                    if (strpos($textohtml_resto,'http://ouo.io/s/y0d65LCP?s=') && $text_before == "<a") {
                        try {
                            $a = new SimpleXMLElement($textohtml_resto);
                            $url_clean = str_replace('http://ouo.io/s/y0d65LCP?s=' , '',$a['href']);
                            $url_clean = urldecode($url_clean);                
                            $textohtml_resto = '<a href="'.$url_clean .'"  target="__black">'.$url_clean .'</a>' ;                
                        } catch (Exception $e) {
                            $textohtml_resto = json_encode( $e );
                            echo '<pre>'; var_dump( $textohtml_resto ); echo '</pre>'; die;/***HERE***/ 
                        }
                    }                                                                            

                }else {
                    $textohtml_resto_not_remove = str_replace($text_before,"TEXTOBEFOREXXX",$textohtml_resto);
                    $textohtml_resto_not_remove = str_replace($text_after,"TEXTOAFTERXXX",$textohtml_resto_not_remove);
                    $textohtml =  str_replace($textohtml_resto,$textohtml_resto_not_remove,$textohtml); 
                    $textohtml_resto =  $textohtml_resto_not_remove;                
                }

                if (!strpos($textohtml_resto,"></a>") || $debug == true) {
                    $validTags[] = $textohtml_resto;                         
                }
            } 

            $i =  $textohtml_resto_init;
            $contador_break++;     
            if ($contador_break == 10000) {
                echo '<pre>'; var_dump( 'Ey, here it is a trouble' ); echo '</pre>'; die; /***HERE***/
            }
        }  
        
        if (isset($validTags)) {            
            $textohtml = implode($tagUnidor,$validTags);
        }      


        return $textohtml;

    }

    // Anime Flv
    static function startIframe($text_full)
    {        
        $resto = self::getTag($text_full,'src="','"','','single');
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
            }else if(strpos($url,'server=ok')) {//Manho - Se mantiene la publicidad :/
                self::getUrlServerOk($url);
            }else if(strpos($url,'s=izanagi')) {//Manho - Se mantiene la publicidad :/
                self::getUrlServerIzanagi($url);
            }elseif (!empty($value)) {
                // $this->echo_resto_iframe[] = $url;
            }           
        }     
    }

    public function getUrlServerIzanagi($url)
    {
        $html_anime = self::get_url_contents($url) ;
        $resto = self::getTag($html_anime,"check.php?","';",'<br>');
        $resto = explode('<br>',$resto);
        $resto = $resto[0];
        $resto = str_replace("';","",$resto);
        $url_video = self::get_url_contents('https://s3.animeflv.com/'.$resto);
        $url_video =  json_decode( $url_video, true );
        if (!empty($url_video['file'])) {                
        ?>
        <video id="myVideo" width="100%" src="<?php echo  $url_video['file'] ?>" onclick="togglePause()" ></video>  
        <input type="button" onclick="playVid()" value="Play" class="btn">
        <input type="button" onclick="pauseVid()" value="Pause" class="btn">
        <input type="button" onclick="goFullscreen()" value="Full Screen" class="btn">
        <script>
            var vid = document.getElementById("myVideo"); 
                function playVid() { 
                    vid.play(); 
                } 
                function pauseVid() { 
                    vid.pause(); 
                }
                function goFullscreen() {
                    if (vid.mozRequestFullScreen) {
                        vid.mozRequestFullScreen();
                    } else if (vid.webkitRequestFullScreen) {
                        vid.webkitRequestFullScreen();
                    }  
                }
        </script>
        <?php 
      }else {
          echo $url_video . '<br>';
      }
    }

    public function getUrlServerOk($url)
    {
        $html_anime = self::get_url_contents($url) ;
        $resto = self::getTag($html_anime,'"https://ok.ru','";','<br>');
        $video = explode('<br>',$resto);
        echo '<hr>';
        foreach ($video as $url_video) {
            if (strpos($url_video,'ttp')) {
                $url_video = str_replace(";","",$url_video);
                $url_video = str_replace('"',"",$url_video);
                echo '<a href="'.$url_video.'" target="__black">VIEW VIDEO OK </a><br>';                   
            }
        }
        echo '<hr>';
    }
    public function getUrlMediafire($url)
    {
        // efire.php
        if ( isset($url)) {
            $html_anime = self::get_url_contents($url) ;
            $final = self::removeTag($html_anime,'<script','</script>','www.mediafire.com');        
            $resto = self::getTag($final,"<script",'</script>');
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
            $resto =  self::removeTag($resto,"var player","XXXXXXXXXX");            
            echo $resto; //script mediafire
        } 
    }
    public function getUrlServerRV($url)
    {
        if ( isset($url)) {
            $code_video = explode('value=',$url);
            if (isset($code_video[1])) {
                // https://www.rapidvideo.com/e/FT2X37EBZV&q=480p
                $html_anime = self::get_url_contents("https://www.rapidvideo.com/e/". $code_video[1]."&q=full") ;
                // if (false) {
                if (strpos($html_anime,"<video")) {
                    $video = self::getTag($html_anime,"<video",'</video>');
                    $video = self::getTag($video,'src="','"','<br>','only');
                    $video = explode('<br>',$video);
                    echo '<hr>';
                    foreach ($video as $url_video) {
                        if (strpos($url_video,'ttp')) {
                            echo '<a href="'.$url_video.'" target="__black">VIEW VIDEO RV </a><br>';                   
                        }
                    }
                }else {
                    // view-source:https://www.rapidvideo.com/e/FK4UCNFLW2&q=full
                    echo '<span">VIEW VIDEO RV  NOT :/</span><br>';
                    ?>
                    <input type="text" name="" id="" value="view-source:<?php echo "https://www.rapidvideo.com/e/". $code_video[1]."&q=full" ?>">
                    <!-- <iframe src="https://www.rapidvideo.com/e/<?php echo $code_video[1] ?>&q=full" frameborder="0"></iframe>   -->
                    <?php
                }               
            }            
        } 
    }

    public function getUrlServerRVCopy($url)
    {
        if ( isset($url)) {
                $html_anime = self::get_url_contents($url."&q=full") ;
                // if (false) {
                if (strpos($html_anime,"<video")) {
                    $video = self::getTag($html_anime,"<video",'</video>');
                    $video = self::getTag($video,'src="','"','<br>','only');
                    $video = explode('<br>',$video);
                    echo '<hr>';
                    foreach ($video as $url_video) {
                        if (strpos($url_video,'ttp')) {
                            echo '<a href="'.$url_video.'" target="__black">VIEW VIDEO RV </a><br><br><br>';                   
                        }
                    }
                }else {
                    // view-source:https://www.rapidvideo.com/e/FK4UCNFLW2&q=full
                    echo '<span">VIEW VIDEO RV  NOT :/</span><br>';
                    ?>
                    <input type="text" name="" id="" value="view-source:<?php echo "https://www.rapidvideo.com/e/". $code_video[1]."&q=full" ?>">
                    <!-- <iframe src="https://www.rapidvideo.com/e/<?php echo $code_video[1] ?>&q=full" frameborder="0"></iframe>   -->
                    <?php
                }                          
        } 
    }

    public function getUrlServerMega($url)
    {
        if ( isset($url)) {
            $html_anime = self::get_url_contents($url) ;
            $final = self::getTag($html_anime,"https://mega.nz",'";');
            $resto =  explode('<br>',$final);
            foreach ($resto as $url) {
               if (!empty($url) && strpos($url,'ttps://mega.nz')) {
                  echo '<a href="'.$url.'" target="__black">VIEW VIDEO  MEGA </a><br>';                  
               }
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

    public function markerView($urlView)
    {
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
        $views = file_get_contents("../animeflv/json/view.json");
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
            if (count($viewsAll) < 300) {
                $myfile = fopen("../animeflv/json/view.json", 'w+') or die('nop');
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
