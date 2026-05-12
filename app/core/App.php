<?php
require_once __DIR__ . '/Router.php';

class App {


    public function run(): void {

        session_start();


        $router = new Router();
        $router->run();
    }
}
