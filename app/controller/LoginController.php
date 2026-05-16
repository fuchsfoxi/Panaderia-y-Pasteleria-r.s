<?php

require_once __DIR__ . ("/../config/Config.php");
require_once __DIR__ . ("/../core/Controller.php");
require_once __DIR__ . ("/../models/login.php");

class  LoginController extends controller{

public function index():void {
    $error = null;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $usuario = trim($_POST['user'] ?? '');
        $clave = trim($_POST['password'] ?? '');

        if(empty($usuario) || empty($clave)){
            $error = "Por favor complete todos los campos.";
        
        }else{
            $resultado = (new Login())->login($usuario, $clave);

            if($resultado){
                $_SESSION['usuario'] = $resultado;



                header('Location:'. BASE_URL . '/dashboard');
                exit;
            }else{
                $error = 'Usuario o contraseña incorrectos.';
            }
        }
    }
    $this->view('auth/login', ['error' => $error]);
}
}