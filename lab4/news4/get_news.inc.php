<?php
$res = $news->getNews();

if (!$res) {
    $errMsg = "Произошла ошибка при выводе новостей";
} else {
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        echo "<h3>{$row['title']}</h3>";
        echo "<p>{$row['description']}</p>";
        echo "<a href='?del={$row['id']}'>Удалить</a>";
        echo "<hr>";
    }
}
