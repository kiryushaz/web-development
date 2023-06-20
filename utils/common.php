<?php 
// страница с кодовой ошибкой
function raiseError($code) {
    header("HTTP/1.0 $code");
    die();
    #http_response_code($code);
    #header("Location: /errors/$code.php");
}

function is_admin($user) {
    require_once($_SERVER['DOCUMENT_ROOT']."/utils/db.php");
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();

    $item = $stmt->get_result()->fetch_assoc();

    return boolval($item['is_admin']);
}

?>