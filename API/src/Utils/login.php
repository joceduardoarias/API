<?php

namespace App\Utils;
use \Firebase\JWT\JWT;
use App\Models\Usuarios;

class Login{

    public function loginToken($datos)
    {
        $jwt = "";
        $file = "token.json";
        $mtxUsuario = json_encode(Usuarios::where("email","=",$datos['email'])
                                            ->where("clave","=",$datos['clave'])->get());
        // var_dump(json_encode( $mtxUsuario));
        $objUsuario = json_decode($mtxUsuario);
        $existe = ($objUsuario != null )? true : false;
        if ( $existe) {
            $key ="pro3-parcial";
            $payload = array(
                "iss" => "http://example.org",
                "aud" => "http://example.com",
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "email"=> $objUsuario[0]->email,
                "clave" => $objUsuario[0]->clave,
                "tipo" => $objUsuario[0]->tipo
            );
        
            $jwt = JWT::encode($payload, $key);
        }
       return $jwt;
    }

    public function ValidarToken($token)
    {   
        try {
                $jwt =$token;
                $key ="pro3-parcial";
                $jwtDecoded = JWT::decode($jwt[0],$key,array('HS256'));
            
                return $jwtDecoded;

        } catch (Exception $e) {
            //throw $th;
            http_response_code(401);
            return $jwtDecoded = null;
        }
        
    }
}