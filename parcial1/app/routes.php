<?php

/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 15/4/2017
 * Time: 2:21 AM
 */

function call($controller, $action)
{
    $file_controller = 'controllers/' . $controller . '_controller.php';
    //$file_controlleradmin = 'controllers/administracion/' . $controller . '_controller.php';
    ///echo $file_controller;
    require_once($file_controller); ///aqui se hace existencia de las CLASS
    require_once('models/login.php');
    require_once('models/login.php');
    require_once('models/imagen.php');
    require_once('models/Computer_Vision.php');
    require_once('models/IA.php');
    require_once('models/mesa.php');
    require_once('models/partido.php');
    require_once('models/votos.php');
    require_once('models/recinto.php');
    /*require_once('models/cu.php');
    require_once('models/modulo.php');
    require_once('models/privilegio.php');*/

    switch ($controller) {
        case 'pages': //principal
            $controller = new PagesController();
            break;
        case 'login':
            // require_once ('models/login.php');
            $controller = new loginController();
            break;
        case 'ia':
            $controller = new iaController();
            break;
        case 'leerqr':
            $controller = new leerqrController();
            break;
        case 'jurado':
            $controller = new JuradoController();
            break;
        case 'mesa':
            $controller = new mesaController();
            break;
        case 'partido':
            $controller = new PartidoController();
            break;
    }
    $controller->{$action}();
}

// agregar la entrada para el nuevo controlador y sus acciones
$controllers = array(
    'pages' => ['home', 'error', 'home', 'faq'],
    'login' => ['index', 'validar', 'cerrar', 'getallUsers'],
    'leerqr' => ['index'],
    'jurado' => ['index', 'guardar'],
    'partido' => ['index','getPartidos1','getidPartido'],
    'ia' => ['analizarImagen', 'guardar1','prueba'],
    'mesa'=>['getMesas','getidMesa','votosMesaExiste','index','datosVotosMesa','resultados']

);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action); //ok

    } else {
        call('pages', 'error'); //no existe la action 500
    }
} else {
    call('pages', 'error'); //no existe el controller 404
}
