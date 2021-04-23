<?php

function buildWithAuth($callback, $request, $response, $instance) {
    $body = json_decode($request->getBody());
    $auth= decrypt($body->apiKey);
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