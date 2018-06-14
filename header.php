
<!-- https://animeflv.net/browse?q=naruto -->
<!-- <form action="search.php" method="get" >
<input type="text" name="q" id="" placeholder="buscar" value="<?php echo $_REQUEST['q'] ?>">
</form> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.typewatch.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
ul {
  columns: 2;
  -webkit-columns: 2;
  -moz-columns: 2;
}
a{
    background-color: white;
    color: black;
    border: 2px solid #4CAF50;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left: 30px;
    margin: 5px;
}
</style>

<a href="https://animeflv.net<?php echo $_GET['url'] ?>" target="__black">VIEW PAGE ANIMEFLV</a>
<br>
<a href="index.php" >HOME</a>

<br>
<form action="search.php" method="get">
<input name="q" type="text" id="search-anime"  class="form-control" autocomplete="off" placeholder="Buscar..." value="<?php echo $_REQUEST['q'] ?>" style="
    width: 50%;
    max-width: 500px;
    margin:  10px;
">

 <button type="button"  class=" btn-success fa-search" style="
                margin: 5px;
                height: 40px;
                width:100px;
            ">Buscar</button>

</form>
<div class="DpdwCnt TtCn">
<ul class="ListResult"></ul>
</div>
<br>

<!-- Here start Process -->
<br>