<?php
namespace MyProject\Classes;

require_once __DIR__ . "/User.php";
require_once __DIR__ . "/SuperUserInterface.php";

class SuperUser extends User implements SuperUserInterface {

    public static int $count = 0;
    public string $role;

    public function __construct(string $name, string $login, string $password, string $role) {
        parent::__construct($name, $login, $password);
        $this->role = $role;
        self::$count++;
    }

    public function showInfo() {
        parent::showInfo();
        echo "Роль: {$this->role}<br>";
    }

    public function getInfo() {
        return [
            "name" => $this->name,
            "login" => $this->login,
            "role" => $this->role
        ];
    }
}
