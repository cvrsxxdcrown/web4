<?php
require_once "users.php";
require_once "MarkdownView.php";

$view = new MarkdownView();
$view->render($users);
