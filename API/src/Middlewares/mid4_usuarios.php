<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Utils\RegistroValidacion;

class RegistroMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        
        $usuariosValidacion = new RegistroValidacion();
        $valido = $usuariosValidacion->RegistroValidacion($request);

        if ($valido) {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
            $resp = new Response();
            $resp->getBody()->write($existingContent);
        }else {
            $response = new Response();
            throw new \Slim\Exception\HttpForbiddenException($request);
            return $response->withStatus(403);
        }
        
        
        return $response;
    }
}
