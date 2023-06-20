<?php 
$title = "Ошибка";
header("HTTP/1.0 404 Not Found");
require_once($_SERVER['DOCUMENT_ROOT']."/header.php");?>

<h1>Страница не найдена</h1>

<?php require_once($_SERVER['DOCUMENT_ROOT']."/footer.php");?>