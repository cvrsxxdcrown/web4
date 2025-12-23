<?php

class User {
    public string $email;
    public string $name;

    public function __construct($email,$name) {
        $this->email = $email;
        $this->name = $name;
    }
}

class View {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function render() {
        echo '<pre>';
        print_r($this->model);
        echo '</pre>';
    }
}

class Controller {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function render() {
        (new View($this->model))->render();
    }
}

$users = [
    new User('a@mail.com','Ivan'),
    new User('b@mail.com','Petr')
];

(new Controller($users))->render();
