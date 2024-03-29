<?php session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/utils/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/utils/db.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <link rel="stylesheet" href="./style.css">
    <title><?= $title ?></title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="/"><img class="img_logo" src="./images/logo.png" alt="logo"></a>
        </div>
        <nav>
            <ul>
                <li><a class="nav_item" href="/">Главная</a></li>
                <li><a class="nav_item" href="industries.php">Отрасли</a></li>
                <li><a class="nav_item" href="search.php">Список предприятий</a></li>
                <li><a class="nav_item" href="about.php">О нас</a></li>
                <?php if (isset($_SESSION['logged'])) {
                    if (is_admin($_SESSION['logged'])) {
                        echo "<li><a class=\"nav_item\" href=\"cpanel.php\">Админка</a></li>";
                    }
                    echo "<li><a class=\"nav_item\" href=\"logout.php\">".htmlspecialchars($_SESSION['logged'])."</a></li>";
                } else {
                    echo "<li><a class=\"nav_item\" href=\"login.php\">Вход</a></li>";
                } ?>
            </ul>
        </nav>
    </header>
    <main>