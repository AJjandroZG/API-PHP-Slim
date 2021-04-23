<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

// version
$version = "/v1";
// Instantiate App
$app = AppFactory::create();
// Add error middleware
$app->addErrorMiddleware(false, true, true);
// allow CORS

$app->add(function ($request, $handler) {
  $response = $handler->handle($request);
  return $response
          ->withHeader('Access-Control-Allow-Origin', '*')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Content-Type', 'application/json; charset=utf-8');
});
// Controlls and Models
require __DIR__ . '/../models/inventarioportienda.php';
require __DIR__ . '/../controllers/inventarioportienda.php';

// routes
$app->post($version.'/getInventaryByProduct', function(Request $request, Response $response){
    $inventarioportienda = new InventarioportiendaController();
    return buildWithAuth(function($request, $response, $instance){
      return $instance->getInventaryByProduct($request, $response);
    }, $request, $response, $inventarioportienda);
  });

$app->put($version.'/updateInventary', function(Request $request, Response $response){
  $inventarioportienda = new InventarioportiendaController();
  return buildWithAuth(function($request, $response, $instance){
    return $instance->updateInventary($request, $response);
  }, $request, $response, $inventarioportienda);
});

$app->run();