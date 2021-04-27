<?php

function buildWithAuth($callback, $request, $response, $instance) {
    $auth;
    if ($request->getMethod() == "GET") {
        $auth= decrypt($request->getQueryParam('apiKey'));
    }else{
        $body = json_decode($request->getBody());
        $auth= decrypt($body->apiKey);
    }
    //var_dump($auth);
    if (authentication($auth)) {
        return $callback($request, $response, $instance);
    } else {
        $res =  array('success' => false, 'message' => "Error de autenticación");
        return buildResponse($request, $response, 401, $res);
    }
}

function buildWithoutAuth($callback, $request, $response, $instance) {
    return $callback($request, $response, $instance);
}

function authentication($credencial){
    if ($credencial) {
        $credencial = json_decode($credencial);
        // código de consulta a la base de datos si usara una autenticación para varios usuarios
            // ...code#
        //END
        if (
            $credencial->user == $_ENV['USER_DEFAULT'] && 
            $credencial->password == $_ENV['PASSWORD_DEFAULT']
            ) {
            return true;
        } else {
            return false;
        }
    }
}