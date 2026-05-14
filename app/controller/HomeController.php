<?php

require_once __DIR__ . "/../core/controller.php";


class HomeController extends Controller
{
    public function index()
    {
        $this->view("dashboard/index");
    }
}

