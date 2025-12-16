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
        htmlspecialchars($_POST["title"]),
        (int)$_POST["category"],
        htmlspecialchars($_POST["description"]),
        htmlspecialchars($_POST["source"])
    );

    if ($res) {
        header("Location: news.php");
        exit;
    } else {
        $errMsg = "Произошла ошибка при добавлении новости";
    }
}
