
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

echo '<a style="    background-color: #4CAF50;
border: none;
color: white;
padding: 15px 32px;
margin: 10px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 22px;
width: 400px;
padding: 5px;" href="list-cap.php?identificador='.$_REQUEST['identificador']."&MangaNameFull=".str_replace(' ','-',$_REQUEST['name']).'">Back</a><br>';
echo '<center><h3>Capítulo'.$_REQUEST['page'].'</h3></center><br>';
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
    // padding: 5px;" target="__black" href="'.$file.'">'.$number_page.'</a></center><br>';

    $list[] = array('link'=>$file,'number'=>$number_page);
}

?>
<div class="w3-content w3-display-container">
<?php foreach ($list as $link): ?>


    <img class="mySlides" src="<?php echo $link['link'] ?>" style="width:100%">
 

<?php endforeach ?>

<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)" style="color: red;">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>
<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = x.length} ;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
    }
    x[slideIndex-1].style.display = "block"; 
    }
</script>
</body>
 

