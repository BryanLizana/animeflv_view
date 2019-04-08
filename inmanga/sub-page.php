
<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
echo $_SESSION['list_url_pages_btns'];

?>


<div class="w3-content w3-display-container">


<div style="position: absolute;">
<a href="?sub_page=<?php echo $_REQUEST['sub_page'] - 1 ?>">
<button class="w3-button w3-black "  style="padding: 9px;">❮</button>
</a>

<a href="?sub_page=<?php echo $_REQUEST['sub_page'] + 1 ?>">
<button class="w3-button w3-black "  style="padding: 9px;">❯</button>
</div>
</a>

<div style="text-align: right;">
<a href="?sub_page=<?php echo $_REQUEST['sub_page'] - 1 ?>">
<button class="w3-button w3-black "  style="padding: 9px;">❮</button>
</a>

<a href="?sub_page=<?php echo $_REQUEST['sub_page'] + 1 ?>">
<button class="w3-button w3-black "  style="padding: 9px;">❯</button>
</div>
</a>
</div>


<img class="mySlides" src="<?php echo   $_SESSION['list_url_pages'][$_REQUEST['sub_page']]['link'] ?>" style="width:100%">


</div>
</body>
</html>