<?php
require_once("utils/db.php");

$title = "Авторизация";
require_once("header.php");

$errors = array();
if(isset($_POST['login'])){
	$user = trim($_POST['user']);
    $password = $_POST['password'];

    if(!$user) {
        $errors[] = "Введите имя пользователя";
    }
    if(!$password) {
        $errors[] = "Введите пароль";
    }
    if(!$errors):
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $item = $result->fetch_assoc();

            if(!password_verify($password, $item['password'])) {
                $errors[] = "Вы ввели неверный пароль!";
            }
        } else {
            $errors[] = "Пользователь не найден";
        }
    endif;

if($errors): ?>
<div class="error_msg">
    <p><?= array_shift($errors);?></p>
</div>
<?php else:
    $_SESSION['logged'] = $user;
    header("Location: index.php");
endif; 
}?>

<div class="authorization">
    <form action="login.php" method="post">
        <p>Введите логин:</p><input type="text" name="user" value="<?= @htmlspecialchars($user) ?>"><br><br>
        <p>Введите пароль:</p><input type="password" name="password" value="<?= @htmlspecialchars($password) ?>"><br><br>
        <button type="submit" name="login">Авторизоваться</button>
        <button type="reset">Очистить</button>
    </form>
</div>
<br>
<p>Не зарегистрированы? <a href="signup.php">Кликните сюда</a></p>

<?php require_once("footer.php");?>
