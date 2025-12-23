<?php
namespace Project\Controllers;

use Core\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $this->title = 'Меню лабораторной 8';

        return $this->render('menu/index');
    }
}
