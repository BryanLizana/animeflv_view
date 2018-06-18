
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body style="
    margin:  16px;
">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.typewatch.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
/* General */

a{
    background-color: white;
    color: black;
    border: 2px solid #4CAF50;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    font-size: 27px;
    min-height: 100px;
    width:100%;
    max-width:1500px;
}

.btn-success{
    margin: 5px;
    height: 80px;
    width:100%;
    max-width:1500px;

}
.input-text{
    margin: 5px;
    height: 80px;
    width:100%;
    max-width:1500px;
 
}


</style>

<a href="https://animeflv.net<?php echo $_GET['url'] ?>" style="
    display: contents; */
" target="__black">VIEW PAGE ANIMEFLV</a>
<br>
<br>
<!-- <a href="planet.php">HOME PLANET</a> <br> -->
<a href="planet.php?url=/users/BryanLizana/anime/watching">View List BryanLizana</a>
<br>
<a href="index.php" >HOME</a>

<br><br>
<form action="search.php" method="get">
<input name="q" type="text" id="search-anime"  class="form-control input-text" autocomplete="off" placeholder="Buscar..." value="<?php echo $_REQUEST['q'] ?>" >
<input type="submit" class=" btn-success fa-search" value="Buscar">
</form>
<div class="DpdwCnt TtCn">
<ul class="ListResult"></ul>
<span>-------Fin Search-------</span>
</div>
<br>

<h2><?php echo str_replace('-',' ',$_REQUEST['url']) ?></h2>

<!-- Here start Process -->
<br>