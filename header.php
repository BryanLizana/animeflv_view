
<!-- https://animeflv.net/browse?q=naruto -->
<!-- <form action="search.php" method="get" >
<input type="text" name="q" id="" placeholder="buscar" value="<?php echo $_REQUEST['q'] ?>">
</form> -->
<a href="https://animeflv.net<?php echo $_GET['url'] ?>" target="__black">VIEW PAGE ANIMEFLV</a>
<br>
<a href="index.php" >HOME</a>

<br>
<form action="search.php" method="get">
<input name="q" type="text" id="search-anime" autocomplete="off" placeholder="Buscar..." value="<?php echo $_REQUEST['q'] ?>">
<button><i class="fa-search">Buscar</i></button>
</form>
<div class="DpdwCnt TtCn">
<ul class="ListResult"></ul>
</div>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.typewatch.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>

<!-- Here start Process -->
<br>