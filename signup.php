<?php
require_once("utils/db.php");

$title = "Регистрация";
require_once("header.php");

$errors = array();
if(isset($_POST['signup'])){

    if(!trim($_POST['user'])) {
        $errors[] = "Введите имя пользователя";
    }
    if(!trim($_POST['email'])) {
        $errors[] = "Введите адрес электронной почты";
    }
    if(!trim($_POST['password1'])) {
        $errors[] = "Введите пароль";
    }
    if($_POST['password1'] != $_POST['password2']) {
        $errors[] = "Пароли не совпадают";
    }

if($errors): ?>
<div class="error_msg">
    <p><?= array_shift($errors);?></p>
</div>
<?php else:
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $sql = sprintf("INSERT INTO users (username, email, password) VALUES ('%s', '%s', '%s')", 
            $mysqli->real_escape_string($user),
            $mysqli->real_escape_string($email),
            $mysqli->real_escape_string($password));

    $mysqli->query($sql);
    
    $_SESSION['logged'] = $user;

    header("Location: index.php");
endif; 
}?>

<div class="authorization">
    <form action="signup.php" method="post">
        <p>Введите имя:</p><input type="text" name="user" value="<?= @htmlspecialchars($_POST['user']) ?>"><br><br>
        <p>Введите email:</p><input type="email" name="email" value="<?= @htmlspecialchars($_POST['email']) ?>"><br><br>
        <p>Введите пароль:</p><input type="password" name="password1" value="<?= @htmlspecialchars($_POST['password1']) ?>"><br><br>
        <p>Введите пароль еще раз:</p><input type="password" name="password2" value="<?= @htmlspecialchars($_POST['password2']) ?>"><br><br>
        <button type="submit" name="signup">Зарегистрироваться</button>
        <button type="reset">Очистить</button>
    </form>
</div>

<?php require_once("footer.php");?>