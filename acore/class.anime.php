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

    public function getTag($textohtml,$text_before,$text_after = false,$tagUnidor= "<br> \n\r", $mode = 'completo', $menosSiTieneThisWord = false)
    {

        if (strpos($textohtml,'figure>')) {
            $textohtml = self::removeTag($textohtml,'<figure>','</figure>');
        }
    
        $textohtml_backup = $textohtml;            
        $i= true; //mientras text_before_exist
        $contador_break = 0;
        if (!$text_after || empty($text_after)) {
            $text_after = str_replace('<','</',$text_before);
        }

        while ($i) {
            $textohtml_resto_init = strpos($textohtml,$text_before); //mientras text_before_exist

            $textohtml_resto_end = strpos($textohtml,$text_after);

           if ($textohtml_resto_init) {
                $textohtml_resto = substr($textohtml,$textohtml_resto_init,($textohtml_resto_end + strlen($text_after)) -  $textohtml_resto_init); //texto a remover
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
                    $textohtml =  str_replace($textohtml_resto,"",$textohtml);
                    
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
    
                    if (!strpos($textohtml_resto,"></a>")) {
                         $validTags[] = $textohtml_resto; 
                    }

                }else {
                    $textohtml_resto_not_remove = str_replace($text_before,"TEXTOBEFOREXXX",$textohtml_resto);
                    $textohtml_resto_not_remove = str_replace($text_after,"TEXTOAFTERXXX",$textohtml_resto_not_remove);
                    $textohtml =  str_replace($textohtml_resto,$textohtml_resto_not_remove,$textohtml); 
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

}
