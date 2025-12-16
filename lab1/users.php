<?php

spl_autoload_register(function ($class) {
    $path = str_replace("\\", "/", $class) . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
});

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

$user1 = new User("Иван", "ivan", "123");
$user2 = new User("Мария", "maria", "456");
$user3 = new User("Петр", "petr", "789");

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

echo "<hr>";

$admin = new SuperUser("Админ", "admin", "root", "administrator");
$admin->showInfo();

echo "<pre>";
print_r($admin->getInfo());
echo "</pre>";

echo "<hr>";
echo "Всего обычных пользователей: " . User::$count . "<br>";
echo "Всего супер-пользователей: " . SuperUser::$count . "<br>";
