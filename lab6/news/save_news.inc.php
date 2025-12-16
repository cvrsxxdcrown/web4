<?php
if (
    empty($_POST["title"]) ||
    empty($_POST["category"]) ||
    empty($_POST["description"]) ||
    empty($_POST["source"])
) {
    $errMsg = "Заполните все поля формы!";
} else {
    $res = $news->saveNews(
        $_POST["title"],
        (int)$_POST["category"],
        $_POST["description"],
        $_POST["source"]
    );

    if ($res) {
        header("Location: news.php");
        exit;
    } else {
        $errMsg = "Ошибка при добавлении новости";
    }
}
