<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class AdministradorController {

    public static function index(Router $router) {

        session_start();
        isAuth();
        $alertas = [];
        
        if($_SESSION['rangoId'] == 1) {

        $usuarios = Usuario::all();

        } else {
            header('Location: /dashboard');
        }


        $router->render('administracion/index', [
            'titulo' => 'Administración',
            'usuarios' => $usuarios,
            'alertas' => $alertas
        ]);
    }
    public static function actualizar(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            // $alertas = $usuario->validar_perfil();

            if(empty($alertas)) {

                $existeUsuario = Usuario::where('email', $_POST['email']);

                if($existeUsuario && $existeUsuario->id !== $usuario->id ) {
                    // Mensaje de error
                    Usuario::setAlerta('error', 'Email no válido, ya pertenece a otra cuenta');
                    $alertas = $usuario->getAlertas();
                } else {
                    // Guardar el registro
                    $resultado = $usuario->guardar();

                    Usuario::setAlerta('exito', 'Guardado Correctamente');
                    $alertas = $usuario->getAlertas();

                    // Asignar el nombre nuevo a la barra
                    if($_SESSION['id'] === $usuario->id) {
                        $_SESSION['nombre'] = $usuario->nombre;
                    }
                    //Redireccionar
                    if($resultado) {
                        header('Location: /administracion');
                    }
                }
            }
        }
        
        $router->render('administracion/index', [
            'titulo' => 'Administración',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    
    public static function eliminar(Router $router) {
        session_start();
        isAuth();
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar que el proyecto exista
            $usuario = Usuario::where('id', $_POST['id']);

            session_start();

            if(!$usuario || $_SESSION['rangoId'] == 3) {
                Usuario::setAlerta('error', 'No tienes autorización para elimiar al usuario');
                $alertas = $usuario->getAlertas();
            } else {

                $resultado = $usuario->eliminar();

                Usuario::setAlerta('exito', 'Eliminado Correctamente');
                $alertas = $usuario->getAlertas();

                if($resultado) {
                    header('Location: /administracion');
                }
            }
        }
        $router->render('administracion/index', [
            'titulo' => 'Administración',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

}