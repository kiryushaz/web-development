<?php
$title = "Главная страница";
require_once("header.php");
?>

<!-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Главная страница</title>
</head>
<body>
    <header>
        <div class="logo">
            <img class="img_logo" src="./logo.png" alt="logo">
        </div>
        <nav>
            <ul>
                <li><a class="nav_item" href="#">Главная</a></li>
                <li><a class="nav_item" href="#">Отрасли</a></li>
                <li><a class="nav_item" href="#">Список предприятий</a></li>
                <li><a class="nav_item" href="#">О нас</a></li>
            </ul>
        </nav>
        
    </header>
    <main> -->
        <h1>Справочник предприятий и организаций</h1>
        <div class="search_field">
            <form action="search.php">
                <input type="search" name="q" placeholder="Введите текст для поиска" required>
                <button type="submit">Найти</button>
            </form>
        </div>
        <div class="content">
            <p>Добро пожаловать на сайт "Справочник предприятий и организаций"! Здесь вы можете просмотреть каталог предприятий города Омска.<br>
                Воспользуйтесь поиском выше, чтобы найти нужное предприятие/организацию или просмотрите весь список, перейдя на страницу "Список предприятий".</p>
        </div>
<?php
require_once("footer.php");
?>
    <!-- </main>
    <script src="./script.js"></script>
</body>
</html> -->