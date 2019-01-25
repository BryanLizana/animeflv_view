<?php 

if ($_REQUEST['identificador']) {
    $content_file = file_get_contents("json/view.json");

    $myfile = fopen("./json/view.json", 'w+') or die('nop');


    $data_old =  json_decode($content_file,true);
    $content_file = array();
    for ($i=0; ( !empty($data_old) && $i < count($data_old)); $i++) { 
        if ($data_old[$i]['manga'] != $_REQUEST['identificador']) {
            $content_file[] = $data_old[$i];
         }
    }

    fwrite($myfile, json_encode( $content_file));
    fclose($myfile);

    header('location: index.php' );
    
    // return to home
}