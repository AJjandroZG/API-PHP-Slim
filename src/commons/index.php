<?php

function responseModels($response){
    if ($response->rowCount() > 0){
        $data = $response->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }else {
        return "empty";
    }
}

function isEmpty($response){
    return $response == "empty";
};

function encryptObj($value, $request, $response){
    // código de consulta a la base de datos si usara una autenticación para varios usuarios
            // ...code#
        //END
    if (
        $value->user == $_ENV['USER_DEFAULT'] && 
        $value->password == $_ENV['PASSWORD_DEFAULT']
        ) {
        $enc = encrypt(json_encode($value));
        $res =  array(
            'success' => true,
            'message' => "Llave generada exitosamente.",
            'apiKey' => $enc
        );
        return buildResponse($request, $response, 200, $res);
    } else {
        $res =  array(
            'success' => false,
            'message' => "Error."
        );
        return buildResponse($request, $response, 401, $res);
    }
}

 function encrypt($valor){
    $iv = base64_decode($_ENV['VI_ENCRYPT']);
    $response = openssl_encrypt ($valor, $_ENV['METOD_ENCRYPT'], $_ENV['KEY_ENCRYPT'], false, $iv);
    return str_replace("+", "*", $response);
 };

 function decrypt($valor){
    $iv = base64_decode($_ENV['VI_ENCRYPT']);
    $valor=str_replace("*", "+", $valor);
    $encrypted_data = base64_decode($valor);
    return openssl_decrypt($valor, $_ENV['METOD_ENCRYPT'], $_ENV['KEY_ENCRYPT'], false, $iv);
 };

 function buildResponse($request, $response, $staus, $data){
    echo json_encode($data);
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus($staus);
 }

