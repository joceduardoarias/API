<?php
use Slim\App;
use App\Middleware\BeforeMiddleware;
use App\Middleware\AfterMiddleware;
use App\Middleware\AlumnoValidateMiddleware;

return function (App $app) {
    
    $app->addBodyParsingMiddleware();
    // $app->add( AlumnoValidateMiddleware :: class); 
    // $app->add(BeforeMiddleware :: class);
    $app->add(new AfterMiddleware());
    
};