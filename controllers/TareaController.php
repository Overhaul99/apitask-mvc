<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use Model\Tarea;

class TareaController {
    public static function index() {
        $proyectoId = $_GET['id'];

        if(!$proyectoId) header('Location: /dashboard');
        session_start();
        $proyecto = Proyecto::where('url', $proyectoId);
        $usuario = Usuario::find($_SESSION['id']);
        $nombre = $usuario->nombre;

        if(!$proyecto || $proyecto->propietarioId !== $_SESSION['area']) header('Location: /404');
        
        $tareas = Tarea::belongs('proyectoId', $proyecto->id, 'encargado', $nombre);
        
        echo json_encode(['tareas'=>$tareas]);
    }

    //Crear Tarea
    public static function crear() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $proyectoId = $_POST['proyectoId'];

            $proyecto = Proyecto::where('url', $proyectoId);

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['area']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje'=> 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            //Todo bien, instanciar y crear tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id'=> $resultado['id'],
                'mensaje'=> 'Tarea Creada Correctamente',
                'proyectoId'=> $proyecto->id
            ];
            echo json_encode($respuesta);

        }
    }

    //Actualizar Tarea
    public static function actualizar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Validar que el proyecto exista
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            session_start();

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['area']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje'=> 'Hubo un error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;

            $resultado = $tarea->guardar();
            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'proyectoId' => $proyecto->id,
                    'mensaje' => 'Actualizado correctamente'
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }
        }
    }

    //Eliminar Tarea
    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Validar que el proyecto exista
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            session_start();

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['area']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje'=> 'Hubo un error al eliminar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tarea($_POST);
            $resultado = $tarea->eliminar();

            $resultado = [
                'resultado' => $resultado,
                'mensaje' => 'Eliminado Correctamente',
                'tipo' => 'exito'
            ];

            echo json_encode($resultado);
        }
    }
}