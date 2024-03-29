<?php
$title = "Главная страница";
require_once("header.php");
?>
<h1>Справочник предприятий и организаций</h1>
<div class="search_field">
    <form action="search.php">
        <input type="search" name="q" id="ajax" placeholder="Введите текст для поиска" required>
        <button type="submit">Найти</button>
    </form>
    <div>
        <p id="search_results"></p>
    </div>
</div>
<div class="content">
    <p>Добро пожаловать на сайт "Справочник предприятий и организаций"!<br> С удовольствием используйте удобный и надежный инструмент для поиска нужной информации о компаниях и предприятиях в вашем городе или регионе. Здесь вы можете найти контактные данные, адреса, отзывы и оценки других пользователей, а также дополнительную информацию о деятельности компаний. Сайт поможет вам быстро и легко найти нужную информацию о бизнесе, с которым вы хотите связаться или сотрудничать.</p>
</div>

<?php require_once("footer.php");?>
