<?php
require_once("utils/common.php");
require_once("utils/db.php");

$_GET['id'] = intval(preg_replace("/[^0-9]/", "", $_GET['id']));

$stmt = $mysqli->prepare("SELECT * FROM organizations WHERE id = ?");
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: errors/404.php", true);
}

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
        <?php if(isset($_SESSION['logged'])) { 
            echo '<br><br><a href="search.php">Оставить отзыв</a>'; 
            if (is_admin($_SESSION['logged'])) {
                echo '<br><br><a href="cpanel.php?type=editCompany">Редактировать</a>'; 
            }
        } ?>
    </div>
    <div class="company_logo">
        <img src="./images/<?= $items['img_path']?>" alt="img">
    </div>
</div>

<div id="map_canvas"></div>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
<?php require_once("footer.php"); ?>
