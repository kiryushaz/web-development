<?php
require_once("utils/db.php");

$title = "Отрасли";
require_once("header.php");
?>
<h1>Справочник предприятий и организаций</h1>
<div class="search_field">
    <form action="search.php">
        <input type="search" name="q" placeholder="Введите текст для поиска" required>
        <button type="submit">Найти</button>
    </form>
</div>
<div class="content">
    <h2>Выберите нужную отрасль</h2>
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
    </ul>
</div>
<?php require_once("footer.php"); ?>