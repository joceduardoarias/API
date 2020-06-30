<?php

use Slim\Routing\RouteCollectorProxy;

use App\Controllers\LoginController;
use App\Controllers\UsuariosController;
use App\Controllers\MascotasController;
use App\Controllers\TurnosController;
use App\Middleware\BeforeMiddleware;
use App\Middleware\AfterMiddleware;
use App\Middleware\TurnosMiddleware;
use App\Middleware\RegistroMiddleware;

use  App\Controllers\Tipo_mascotaController;
use App\Middleware\TipoMascotaMiddleware;

return function ($app) {
  


    $app->group('/login', function (RouteCollectorProxy $group) {
        
        $group->post('[/]', LoginController::class . ':addLogin');
       
    });

    $app->group('/registro', function (RouteCollectorProxy $group) {
        
        $group->post('[/]', UsuariosController::class . ':add')->add(RegistroMiddleware::class);
       
    });

    $app->group('/tipo_mascota', function (RouteCollectorProxy $group) {
        
        $group->post('[/]', Tipo_mascotaController::class . ':add')->add(BeforeMiddleware::class)->add(TipoMascotaMiddleware::class);
       
    });

    $app->group('/mascotas', function (RouteCollectorProxy $group) {
        
        $group->post('[/]', MascotasController::class . ':add')->add(BeforeMiddleware::class);
       
    });

    $app->group('/turnos', function (RouteCollectorProxy $group) {
        
        $group->post('/mascota', TurnosController::class . ':add')->add(BeforeMiddleware::class)->add(TurnosMiddleware::class);
       
    });
};