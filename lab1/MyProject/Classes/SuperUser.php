<?php
namespace MyProject\Classes;

class SuperUser extends User implements SuperUserInterface {

    public static int $count = 0;
    private string $role;

    public function __construct(string $name, string $login, string $password, string $role) {
        parent::__construct($name, $login, $password);

        User::$count--;

        $this->role = $role;
        self::$count++;
    }

    public function getInfo(): array {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'role' => $this->role
        ];
    }

    public function showInfo(): void {
        echo "Супер-пользователь: {$this->name}, роль: {$this->role}<br>";
    }
}
