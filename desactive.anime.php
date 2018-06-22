<?php 
require_once('./include.php');
$AnimeFlv->viewDesactive($_REQUEST['url']);

header('location:index_index.php');