<?php
require_once "NewsDB.class.php";

$news = new NewsDB();
$errMsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "save_news.inc.php";
}

if (isset($_GET["del"])) {
    require "delete_news.inc.php";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
</head>
<body>

<h1>Последние новости</h1>

<?php
if ($errMsg !== "") {
    echo "<p style='color:red'>$errMsg</p>";
}
?>

<form method="post">
    Заголовок: <input type="text" name="title"><br>
    Категория (id): <input type="number" name="category"><br>
    Описание: <input type="text" name="description"><br>
    Источник: <input type="text" name="source"><br>
    <button type="submit">Добавить</button>
</form>

<hr>

<?php require "get_news.inc.php"; ?>

</body>
</html>
