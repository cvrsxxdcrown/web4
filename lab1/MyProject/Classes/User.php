<?php
namespace MyProject\Classes;

class User extends AbstractUser {

    public static int $count = 0;

    public string $name;
    public string $login;
    private string $password;

    public function __construct(string $name, string $login, string $password) {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        self::$count++;
    }

    public function showInfo() {
        echo "Имя: {$this->name}, Логин: {$this->login}<br>";
    }

    public function __destruct() {
        echo "Пользователь {$this->login} удален.<br>";
    }
}
