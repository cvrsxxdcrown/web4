<?php
require_once "NumbersSquared.php";

$obj = new NumbersSquared(3, 7);

foreach ($obj as $num => $square) {
    echo "Квадрат числа $num = $square<br>";
}
