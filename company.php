<?php
define("DATABASE", "test");

$mysqli = new mysqli("localhost", "root", "", DATABASE);

if ($mysqli->connect_error) {
    exit('Error ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error);
}
if (!$mysqli->select_db(DATABASE)) {
    exit('Cannot select database');
}

$sql = "SELECT * FROM Organizations WHERE `id` = " . $_GET['id'];
$result = $mysqli->query($sql);

$items = $result->fetch_assoc();

$title = $items['org_name'];
require_once("header.php");
?>
<div class="company">
    <div class="company_desc">
        <h1><?= $title?></h1>
        <br>
        <p><?= $items['org_descr']?></p>
        <br>
        <p>Адрес компании: <?= $items['org_address']?></p>
        <p>Телефон компании: <?= $items['phone_no']?></p>
        <!-- <?php 
            foreach ($items as $key => $value) {
                echo "<p>$key => $value</p><br>";
            }
        ?> -->
        <br><a href="search.php">&lt;&lt; Вернуться назад</a>
    </div>
    <div class="company_logo">
        <img src="./images/<?= $items['img_path']?>" alt="img">
    </div>
</div>
<?php
require_once("footer.php");
?>