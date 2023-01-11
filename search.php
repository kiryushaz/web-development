<?php
define("DATABASE", "test");

$mysqli = new mysqli("localhost", "root", "", DATABASE);

$sql = "SELECT org.id, `org_name`, `org_address`, `phone_no`, `img_path`, `category_name`
        FROM Organizations org JOIN Categories cat ON org.category_id = cat.id";

$h1 = "Общий список предприятий";
$title = "Доступные места";

$error_msg = '';

if (isset($_GET['q'])) {
    $query = trim($_GET['q']);
    $query = $mysqli->real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!$query || strlen($query) < 3) {
        $error_msg = "Вы ввели слишком мало символов";
    } else {
        $sql .= " WHERE org_name LIKE '%$query%'";
        $h1 = "Результаты поиска";
        $title = "Поиск";
    }
}

if (isset($_GET['cat_id'])) {
    $id = trim($_GET['cat_id']);
    $sql .= " WHERE cat.id = $id";
}

// $sql .= " ORDER BY `org_name` ASC";
$result = $mysqli->query($sql);

require_once("header.php");

// define("IMAGE_DEFAULT", "logo.png");
echo "<h1>$h1</h1>";
?>
        <div class="search_field">
            <form>
                <input type="search" name="q" placeholder="Введите текст для поиска" required>
                <button type="submit">Найти</button>
            </form>
        </div>
		<?= "<p class='error_msg'>$error_msg</p><br>";?>
        <div class="content">
            <?php
            if ($result->num_rows > 0) {
                foreach ($result as $row) {
                    $img = $row['img_path']; // ? $row['img_path'] : IMAGE_DEFAULT;
                    echo "<div class='row'><div class='img_row'>";
                    echo "<img src='./images/$img' alt='img' width='150px'/>";
                    echo "</div><div class='desc_row'><p class='org_name'>";
                    echo "<a href='company.php?id=" . $row['id'] . "'>" . $row['org_name'] . "</a></p>";
                    echo "<p class='cat_name'>Категория: " . $row['category_name'] . "</p>";
                    echo "<p>Адрес: " . $row['org_address'] . "</p><p>Телефон: " . $row['phone_no'] . "</p></div></div>";
                }
            } else {
                echo "<h2>По вашему запросу ничего не найдено.</h2>";
            }
            ?>
            <!-- <div class="row">
                <div class="img_row">
                    <img src="./images/logo.png" alt="img" width="150px"/>
                </div>
                <div class="desc_row">
                    <p class='org_name'><a href="/">Наименование организации</a></p>
                    <p>Адрес организации</p>
                    <p>Телефон организации</p>
                </div>
            </div> -->
        </div>
<?php
require_once("footer.php");
?>