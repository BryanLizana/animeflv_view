<?php 
session_start();
$_SESSION['list_url_pages'] = null;
$_SESSION['list_url_pages_btns'] = null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <title><?php echo $_REQUEST['page'] . $_REQUEST['MangaNameFull']?></title>

</head>
<body style="margin:  16px;">
<?php  

require_once('../acore/class.anime.php');

$html_anime = classAnime::get_url_contents('https://inmanga.com/chapter/chapterIndexControls?identification='.$_REQUEST['identificadorPage']);


// $pageid = classAnime::getTag($html_anime,'selected="selected" value="','">'.$_REQUEST['page'].'</option>',"",'parte');
$url_name = classAnime::getTag($html_anime,'href="/ver/manga/',$_REQUEST['identificador'],"",'parte');


$html_anime = classAnime::getTag($html_anime,'Página:','</div>',"<br>",'parte');
$html_anime = classAnime::getTag($html_anime,'<option value="','</option>',"<br>",'parte');

$array =  explode('<br>',$html_anime);
$echo_string = '<center>';

$echo_string .= '<a style="    background-color: #4CAF50;
border: none;
color: white;
padding: 15px 32px;
margin: 10px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 22px;
max-width: 400px;
width:90%;
padding: 5px;"  href="./mark-manga.php?identificador='.$_REQUEST['identificador'].'&page='.$_REQUEST['page'].'&name='.str_replace(' ','-',$_REQUEST['name']).'">Make manga</a><br>';

$echo_string .= '<a style="    background-color: #4CAF50;
border: none;
color: white;
padding: 15px 32px;
margin: 10px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 22px;
max-width: 400px;
width:90%;
padding: 5px;" href="list-cap.php?identificador='.$_REQUEST['identificador']."&MangaNameFull=".str_replace(' ','-',$_REQUEST['name']).'">Back</a><br>';

$echo_string .= '</center>';

$echo_string .= '<center><h3>Capítulo'.$_REQUEST['page'].'</h3></center><br>';
foreach ($array as  $value) {

    $array_values = explode('">',$value);
    $code = $array_values[0];
    $number_page = $array_values[1];

    $file = 'https://inmanga.com/images/manga/'.$url_name.'/chapter/'.$_REQUEST['page'].'/page/'.$number_page.'/'.$code;
    // echo '<center><a  style="    background-color: #4CAF50;
    // border: none;
    // color: white;
    // padding: 15px 32px;
    // margin: 5px;
    // text-align: center;
    // text-decoration: none;
    // display: inline-block;
    // font-size: 22px;
    // width: 400px;
    // padding: 5px;"  href="'.$file.'">'.$number_page.'</a></center><br>';

    $list[] = array('link'=>$file,'number'=>$number_page);

    
    $_SESSION['list_url_pages'] = $list;
    $_SESSION['list_url_pages_btns'] = $echo_string;

    

}

if (!empty($_REQUEST['identificador']) && !empty($_REQUEST['page'])) {
    $content_file = file_get_contents("json/view.json");
    $myfile = fopen("json/view.json", 'w+') or die('nop');
    $data_old =  json_decode($content_file,true);
    for ($i=0; ( !empty($data_old) && $i < count($data_old)); $i++) { 
        if ($data_old[$i]['manga'] == $_REQUEST['identificador']) {
            $data_old[$i]['page'] = $_REQUEST['page']; 
            break;
         }
    }

    fwrite($myfile, json_encode($data_old));
    fclose($myfile);
}
$_SESSION['page'] = $_REQUEST['page'];



header('location: ./sub-page.php?sub_page=0');

?>
