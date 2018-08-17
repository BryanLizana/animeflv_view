<?php 
$urlView = $_REQUEST['url'];
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

        $views = file_get_contents(__DIR__.'/json/view.json');
        $views = json_decode($views,true);

        foreach ($views as  $value) {
           if ( $view_anime_name !=  $value['name']) {
                $viewsAll[] = $value;
           }
        }

        $myfile = fopen(__DIR__."/json/view.json", 'w+') or die('nop');
        $txt = json_encode( $viewsAll );
        fwrite($myfile, $txt);
        fclose($myfile);
    
header('location:index.php');