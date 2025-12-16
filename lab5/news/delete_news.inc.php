<?php
$id = (int)$_GET["del"];

if ($id <= 0) {
    header("Location: news.php");
    exit;
}

$res = $news->deleteNews($id);

if ($res) {
    header("Location: news.php");
    exit;
} else {
    $errMsg = "Произошла ошибка при удалении новости";
}
