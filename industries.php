<?php
$title = "Отрасли";
require_once("header.php");
$mysqli = new mysqli("localhost", "root", "", "test");

// $mysqli->query("CREATE TABLE IF NOT EXISTS Categories(id INT PRIMARY KEY AUTO_INCREMENT, 
//             category_name VARCHAR(255) NOT NULL)");
// $mysqli->query("CREATE TABLE IF NOT EXISTS Organizations(id INT PRIMARY KEY AUTO_INCREMENT, 
//             org_name VARCHAR(255) NOT NULL,
//             org_address VARCHAR(255) NOT NULL,
//             phone_no VARCHAR(11) NOT NULL,
//             org_descr TEXT,
//             img_path VARCHAR(255),
//             category_id INT,
//             FOREIGN KEY (category_id) REFERENCES Categories (id))");
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
            <h2>Выберите нужную отрасль</h2>
            <!-- <?= "<p>" . $mysqli->host_info . "</p>"?> -->
            <ul>
                <?php 
                    $result = $mysqli->query("SELECT * FROM Categories ORDER BY id ASC");

                    if ($result->num_rows > 0) {
                        foreach ($result as $row) {
                        echo "<li><a class='nav_item' href='search.php?cat_id=" . $row['id'] . "'>" . $row['category_name'] . "</a></li>";
                        }
                    } else {
                        echo "Not found";
                    }
                ?>
                <!-- <li><a class="nav_item" href="#">Общественное питание</a></li>
                <li><a class="nav_item" href="#">Бытовые услуги</a></li>
                <li><a class="nav_item" href="#">Салоны красоты</a></li>
                <li><a class="nav_item" href="#">Медицина</a></li>
                <li><a class="nav_item" href="#">Транспорт</a></li>
                <li><a class="nav_item" href="#">Развлечения</a></li> -->
            </ul>
        </div>
<?php
require_once("footer.php");
?>
    <!-- </main>
    <script src="./script.js"></script>
</body>
</html> -->