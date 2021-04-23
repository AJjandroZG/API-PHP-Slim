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
}

 function encrypt($valor){
    $iv = base64_decode($_ENV['VI_ENCRYPT']);
    return openssl_encrypt ($valor, $_ENV['METOD_ENCRYPT'], $_ENV['KEY_ENCRYPT'], false, $iv);
 };

 function decrypt($valor){
    $iv = base64_decode($_ENV['VI_ENCRYPT']);
    $encrypted_data = base64_decode($valor);
    return openssl_decrypt($valor, $_ENV['METOD_ENCRYPT'], $_ENV['KEY_ENCRYPT'], false, $iv);
 };

 function buildResponse($request, $response, $staus, $data){
    echo json_encode($data);
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus($staus);
 }

