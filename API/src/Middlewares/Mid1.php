<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Utils\Login;
class BeforeMiddleware
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
        // $response = $handler->handle($request);
        // $existingContent = (string) $response->getBody();
        // $response = new Response();
        /**
         * VALIDAR JWT
         * getHeader('mi_token)
         */
        $login = new Login();
        $jwt =$request->getHeader('token');
        $valido = $login->ValidarToken($jwt);

        // if ($valido) {
        //     $response->getBody()->write( $existingContent);
        // } else {
        //     $response->getBody()->write('NO autorizado ');
        // }
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
        // $response->getBody()->write('BEFORE ' . $existingContent);
        
        return $response;
    }
}
