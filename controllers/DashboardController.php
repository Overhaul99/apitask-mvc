<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {

        session_start();

        isAuth();

        $usuario = Usuario::find($_SESSION['id']);

        // $id = $_SESSION['id'];
        $area = $_SESSION['area'];

        $proyectos = Proyecto::belongsTo('propietarioId', $area);

        $router->render('dashboard/index', [
            'titulo'=>'Proyectos',
            'proyectos'=>$proyectos,
            'usuario' =>$usuario
        ]);
    }
    
    public static function crear_proyecto(Router $router) {
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            //Validación
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)) {
                //Generar una URL única
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                //Almacenar el creador del proyecto
                $proyecto->propietarioId = $usuario->area;

                //Guardar el Proyecto
                $proyecto->guardar();

                //Redireccionar
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'alertas'=>$alertas,
            'titulo'=>'Crear Proyecto',
            'usuario'=> $usuario
        ]);
    }

    public static function proyecto(Router $router) {
        session_start();
        isAuth();

        $token = $_GET['id'];
        $usuario = Usuario::find($_SESSION['area']);
        if(!$token) header('Location: /dashboard');
        //Revisar que la persona que visita el proyecto es quien lo creo
        $proyecto = Proyecto::where('url', $token);
        if($proyecto->propietarioId !== $_SESSION['area']) {
            
            header('Location: /dashboard');
        }

        $router->render('dashboard/proyecto', [
            'titulo'=>$proyecto->proyecto,
            'usuario'=>$usuario
        ]);
    }

    public static function perfil(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar_perfil();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    //Mensaje de error
                    Usuario::setAlerta('error' ,'Email no válido, ya pertenece a otra cuenta');
                    $alertas = $usuario->getAlertas();
                } else {
                    //Guardar el Usuario
                    $usuario->guardar();

                    Usuario::setAlerta('exito' ,'Guardado Correctamente');
                    $alertas = $usuario->getAlertas();

                    //Asignar el nombre nuevo a la barra
                    $_SESSION['nombre'] = $usuario->nombre;
                }
            }

        }

        $router->render('dashboard/perfil', [
            'titulo'=>'Perfil',
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }

    public static function cambiar_password(Router $router) {
        session_start();
        isAuth();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);

            //Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevo_password();

            if(empty($alertas)) {
                $resultado = $usuario->comprobar_password();

                if($resultado) {
                    $usuario->password = $usuario->password_nuevo;
                    
                    //Eliminar Propiedades no Necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    unset($usuario->password2);

                    //Hashear el nuevo password
                    $usuario->hashPassword();

                    //Actualizar
                    $resultado= $usuario->guardar();

                    if($resultado) {
                        Usuario::setAlerta('exito', 'Contraseña Guardada Correctamente');
                        $alertas = $usuario->getAlertas();
                    }

                } else {
                    Usuario::setAlerta('error', 'Contraseña incorrecta');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('/dashboard/cambiar-password', [
            'titulo' => 'Cambiar password',
            'alertas' => $alertas
        ]);
    }
}