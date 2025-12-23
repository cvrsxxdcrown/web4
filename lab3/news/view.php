<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>News</title>
<style>
body{font-family:Arial;margin:40px}
article{margin-bottom:20px}
</style>
</head>
<body>
<h2>Новости</h2>
<?php foreach($items as $item): ?>
<article>
<b><?=htmlspecialchars($item['title'])?></b><br>
<?=htmlspecialchars($item['content'])?>
</article>
<?php endforeach; ?>
</body>
</html>
