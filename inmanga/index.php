
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Me InManga.com </title>
</head>
<body style="margin:  16px;">
<?php  
// require_once('../acore/class.anime.php');


$json_anime =  file_get_contents('https://inmanga.com/OnMangaQuickSearch/Source/QSMangaList.json');
$array = json_decode($json_anime,true);


echo '<center>
<a style="background-color: #4CAF50;
border: none;
color: white;
padding: 15px 32px;
margin: 10px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 25px;
max-width: 400px;
width:90%;
padding: 5px;" href="./index-img.php">
Modo Index Con Images¡¡ <br>(carga más datos, creo :\'v)</a></center><br>';


$content_file = file_get_contents("json/view.json");

$content_file = json_decode($content_file,true);
foreach ($content_file as $key ) {
    $url = "list-cap.php?identificador=".$key['manga']."&MangaNameFull=".$key['name'];

    echo ' <center>
    <a style="background-color: red;
    border: none;
    color: white;
    padding: 15px 32px;
    margin: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 25px;
    max-width: 400px;
    width:90%;
    padding: 5px;" href="'.$url.'&page='.$key['page'].'">
   '.$key['name']." Page:".$key['page'].'</a></center><br>';
}


echo '<hr>';

foreach ($array as  $value) {
  
    // https://inmanga.com/ver/manga/Another/6ca12a70-53ef-4da8-b3dd-db7c72775e14

    // $url = "page.php?url=ver/manga/".str_replace(' ','-',$value['Name'])."/".$value['Identification'];
    $url = "list-cap.php?identificador=".$value['Identification']."&MangaNameFull=".str_replace(' ','-',$value['Name']);

    echo ' <center>
    <a style="background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    margin: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 25px;
    max-width: 400px;
    width:90%;
    padding: 5px;" href="'.$url.'">
   '.$value['Name'].'</a></center><br>';
}
?>
</body>
 