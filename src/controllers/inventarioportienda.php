<?php
class InventarioportiendaController{
    private $model;

    public function __construct(){
        $model = new Inventarioportienda();
        $this->model = $model;
    }
    
    public function getInventaryByProduct($request, $response){
        try {
            $body = json_decode($request->getBody());
            $resDB = $this->model->filterByProduct($body->product);
            if (!$resDB['success']) {
                return buildResponse($request, $response, 500, $resDB);
            }
            $inventario = $this->model->getData();
            if (!isEmpty($inventario)) {
                $res =  array(
                    'success' => true,
                    'message' => "Datos de inventario por tienda completos",
                    'data' => $inventario
                );
                return buildResponse($request, $response, 200, $res);
            }else {
                $res =  array(
                    'success' => true,
                    'empty' => true,
                    'message' => "No hay datos"
                );
                return buildResponse($request, $response, 200, $res);
            }
        } catch (PDOException $e) {
            $res =  array(
                'success' => false,
                'error' => $e->getMessage()
            );
            return buildResponse($request, $response, 500, $res);

        }
    }

    public function updateInventary($request, $response){
        try {
            $body = json_decode($request->getBody());
            $resDB=$this->model->updateInventary($body->value, $body->product, $body->store);
            if (!$resDB['success']) {
                return buildResponse($request, $response, 500, $resDB);
            }
            if($this->model->getSuccess()){
                $res =  array(
                    'success' => true,
                    'message' => "Actualización exitosa"
                );
                return buildResponse($request, $response, 200, $res);
            }else{
                $res =  array(
                    'success' => false,
                    'message' => "Error database"
                );
                return buildResponse($request, $response, 404);
            }
        } catch (PDOException $e) {
            $res =  array(
                'success' => false,
                'error' => $e->getMessage()
            );
            return buildResponse($request, $response, 500, $res);

        }
    }

    public function getAll($request, $response){
        try {
            $body = json_decode($request->getBody());
            $resDB=$this->model->getAll();
            if (!$resDB['success']) {
                return buildResponse($request, $response, 500, $resDB);
            }
            $inventario = $this->model->getData();
            if (!isEmpty($inventario)) {
                $res =  array(
                    'success' => true,
                    'message' => "Datos completos",
                    'data' => $inventario
                );
                return buildResponse($request, $response, 200, $res);
            }else {
                $res =  array(
                    'success' => true,
                    'empty' => true,
                    'message' => "No hay datos"
                );
                return buildResponse($request, $response, 200, $res);
            }
        } catch (PDOException $e) {
            $res =  array(
                'success' => false,
                'error' => $e->getMessage()
            );
            return buildResponse($request, $response, 500, $res);

        }
    }
}
?>