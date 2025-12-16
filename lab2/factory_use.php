<?php
require_once "users.php";

foreach ($users as $user) {
    echo $user["name"] . " - " . $user["email"] . "<br>";
}
