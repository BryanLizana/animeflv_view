
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body style="margin:  16px;">
<?php  

$json_anime =  file_get_contents('https://inmanga.com/chapter/getall?mangaIdentification='.$_REQUEST['identificador']);
$array = json_decode($json_anime,true);

$array = $array['data'];

$array = json_decode($array,true);

$array = $array['result'];
// echo '<pre>'; var_dump( $array ); echo '</pre>'; die;/***HERE***/ 

echo '<a style="background-color: #4CAF50;
border: none;
color: white;
padding: 15px 32px;
margin: 10px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 22px;
width: 400px;
padding: 5px;" href="index.php">Back</a><br>';


echo '<center><h3>'.$_REQUEST['MangaNameFull'] .'</h3></center><br>';
foreach ($array as  $Number) {

    $url = "page.php?identificadorPage=".$Number['Identification']."&page=".$Number['FriendlyChapterNumber']."&name=".$_REQUEST['MangaNameFull']."&identificador=".$_REQUEST['identificador'];
    $var_a = '<center><a  style="    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    margin: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 22px;
    width: 400px;
    padding: 5px;" href="'.$url.'">'.$Number['FriendlyChapterNumber'].'</a></center><br>';
    // $list[$value['FriendlyChapterNumberUrl']] = $value['Identification'];

    $list[] =  "Page".$Number['Number'].$var_a  ;

}

sort($list, SORT_NATURAL | SORT_FLAG_CASE);
foreach ($list as $key => $var_a) {
    echo $var_a ;
}

?>
</body>
 