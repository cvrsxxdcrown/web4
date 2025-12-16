<?php
$res = $news->getNews();

foreach ($res as $row) {
    echo "<h3>{$row['title']}</h3>";
    echo "<p>{$row['description']}</p>";
    echo "<small>{$row['category']} | {$row['source']}</small><br>";
    echo "<a href='?del={$row['id']}'>Удалить</a>";
    echo "<hr>";
}
