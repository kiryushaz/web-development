<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/utils/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/utils/db.php");

if (isset($_GET['q'])) {
    $q = "%{$_GET['q']}%";
    $stmt = $mysqli->prepare("SELECT `id`, `org_name` FROM Organizations WHERE org_name LIKE ?");
    $stmt->bind_param('s', $q);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="company.php?id='.$row['id'].'">'.htmlspecialchars($row['org_name']).'</a><br>';
    }
}

?>