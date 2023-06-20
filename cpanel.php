<?php
require_once("utils/common.php");
require_once("utils/db.php");
    
$title = "CPanel";
require_once("header.php");

$view_categories = function() use ($mysqli) {
    $result = $mysqli->query("SELECT * FROM `categories`");
    echo "<h2>Список категорий</h2><ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        #print_r($row);
        echo "<li>".$row['category_name']."</li>";
    }
    echo "</ul>";
};

$view_companies = function() use ($mysqli) {
    $result = $mysqli->query("SELECT * FROM `organizations`");
    echo "<h2>Список предприятий</h2><ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        #print_r($row);
        echo "<li>".$row['org_name']."</li>";
    }
    echo "</ul>";
};

$sql_execute = function() use ($mysqli) {
?>
    <h2>Ввод SQL-запроса</h2>
    <form action="cpanel.php?type=sqlExecute" method="post">
        <textarea name="sqltxt" placeholder="Введите запрос" id="sql" cols="50" rows="10" class="txtarea_sql_query"></textarea><br>
        <button type="submit" name="sqlexec">Выполнить</button>
    </form>

<?php if(isset($_POST["sqlexec"])) {
        echo "<br><br>";
        try {
            $result = $mysqli->query($_POST["sqltxt"]);
            echo "<h4>Введенный sql-запрос</h4>";
            #echo "<p>".$_POST["sqltxt"]."</p>";
            echo "<p>".htmlspecialchars($_POST["sqltxt"])."</p><br>";
            if ($result instanceof mysqli_result) {
                echo "<h4>Результат sql-запроса</h4>";
                while ($row = mysqli_fetch_assoc($result)) {
                    print_r($row);
                }
            } else {
                echo "<h4>Запрос выполнен успешно.</h4>";
            };
            
        } catch (\Throwable $th) {
            echo "<p class='error_msg'>Произошла ошибка при вводе SQL-запроса:</p>";
            echo htmlspecialchars($th);
        }
        echo "<br>";
        // $result = $mysqli->query($_POST["sqltxt"])->fetch_all();
        // foreach($result as $row) {
        //     echo $row[1] . '<br>';
        // }
    }
};
if (!isset($_SESSION['logged'])) {
    header("Location: login.php", true);
    die();
}

if (!is_admin($_SESSION['logged'])) {
    header("Location: errors/403.php", true);
    die();
}
    
if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'editCategory':
            $view_categories();
            break;
        case 'editCompany':
            $view_companies();
            break;
        case 'sqlExecute':
            $sql_execute();
            break;
        default:
            header("Location: errors/404.php", true);
            break;
    }
    echo "<br><a href=\"cpanel.php\">Назад</a>";
} else {?>
<h1>Административная панель сайта</h1>
<ul>
    <li><a href="cpanel.php?type=editCategory">Изменение категории</a></li>
    <li><a href="cpanel.php?type=editCompany">Изменение предприятия</a></li>
    <li><a href="cpanel.php?type=sqlExecute">Ввод SQL-запроса</a></li><br>
    <li><a href="index.php">Вернуться на главную страницу</a></li>
</ul>
<br>

<?php
}
require_once("footer.php");?>