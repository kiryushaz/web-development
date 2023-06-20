<?php
define("PAGESIZE", 5);

require_once("utils/db.php");

$sql = "SELECT org.id, `org_name`, `org_address`, `phone_no`, `img_path`, `category_name`
        FROM Organizations org JOIN Categories cat ON org.category_id = cat.id";

$count_sql = "SELECT COUNT(*) FROM Organizations org JOIN Categories cat ON org.category_id = cat.id";

$h1 = "Общий список предприятий";
$title = "Доступные места";

$error_msg = '';
$extra_sql = '';

if (isset($_GET['q'])) {
    $query = $_GET['q'];

    if (!$query || strlen($query) < 3) {
        $error_msg = "Вы ввели слишком мало символов";
    } else {
        #$extra_sql .= " WHERE org_name LIKE '%$query%'";
        $extra_sql .= " WHERE org_name LIKE '%".$mysqli->real_escape_string($query)."%'";
        $h1 = "Результаты поиска";
        $title = "Поиск";
    }
}

if (isset($_GET['cat_id'])) {
    $id = intval(preg_replace("/[^0-9]/", "", $_GET['cat_id']));
    $extra_sql .= " WHERE cat.id = ".$id;
}

if (isset($_GET['page'])) {
    $page = intval(preg_replace("/[^0-9]/", "", $_GET['page']));
    // $page = $mysqli->real_escape_string($_GET['page']);
} else {
    $page = 1;
}

function paginator($p) {
    global $page;

    if ($page == $p) echo '<li>'.$p.' </li>';
    else echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$p.'">'.$p.'</a> </li>';
}

$sql .= $extra_sql;
$count_sql .= $extra_sql;

$count_res = $mysqli->query($count_sql);
$total_rows = mysqli_fetch_array($count_res)[0];

$pages_count = ceil($total_rows / PAGESIZE);

$offset = ($page - 1) * PAGESIZE;

$sql .= " LIMIT $offset, " . PAGESIZE;
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
    <?php if ($result->num_rows > 0) {
        echo "<h2>Найдено $result->num_rows запросов.</h2>";
        foreach ($result as $row) {
            $img = $row['img_path']; // ? $row['img_path'] : IMAGE_DEFAULT;
            echo "<div class='row'><div class='img_row'>";
            echo "<img src='./images/$img' alt='img' width='150px'/>";
            echo "</div><div class='desc_row'><p class='org_name'>";
            echo "<a href='company.php?id=" . $row['id'] . "'>" . $row['org_name'] . "</a></p>";
            echo "<p class='cat_name'>Категория: " . $row['category_name'] . "</p>";
            echo "<p>Адрес: " . ($row['org_address'] ? $row['org_address'] : "не указан") . "</p>";
            echo "<p>Телефон: " . ($row['phone_no'] ? $row['phone_no'] : "не указан") . "</p></div></div>";
        }
        if ($total_rows > PAGESIZE) {
            echo '<ul class="pagination">';
            if ($page == 1) {
                echo '<li>prev</li> ';
            } else {
                echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.($page-1).'">prev</a></li> ';
            }

            for ($p = 1; $p <= $pages_count; $p++)
                paginator($p);

            if ($page == $pages_count) {
                echo '<li>next</li>';
            } else {
                echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.($page+1).'">next</a></li>';
            }
            echo '</ul>';
        }
    } else {
        echo "<h2>По вашему запросу ничего не найдено.</h2>";
    }
?>
</div>
<?php require_once("footer.php");?>
