<?php
class Inventarioportienda{
    private $conexion;
    private $data;
    private $success;

    public function __construct(){
        $db = new db();
        $this->conexion = $db->conectDB();
        $this->data = null;
    }

    public function filterByProduct($product, $request, $response){
        try {
            // consulta a la base
            $sql = "SELECT id_tienda, cantidad_existente, cantidad_inicial FROM inventarioportienda 
              WHERE id_inventario = $product;";
            // respuesta del modelo
            $resultado = $this->conexion->query($sql);
            $this->data = responseModels($resultado);
        } catch (PDOException $e) {
            $res =  array(
                'success' => false,
                'error' => $e->getMessage()
            );
            return $res;
        }
    }

    public function getAll($request, $response){
        try {
            // consulta a la base
            $sql = "SELECT * FROM inventarioportienda;";
            // respuesta del modelo
            $resultado = $this->conexion->query($sql);
            $this->data = responseModels($resultado);
        } catch (PDOException $e) {
            $res =  array(
                'success' => false,
                'error' => $e->getMessage()
            );
            return $res;
        }
    }

    public function updateInventary($value, $product, $store, $request, $response){
        try {
            // consulta a la base
            $sql = "UPDATE inventarioportienda
            SET cantidad_existente=$value
            WHERE id_inventario = $product AND id_tienda=$store;";
            // respuesta del modelo
            $resultado = $this->conexion->query($sql);
            $this->success = $resultado->queryString == $sql;
        } catch (PDOException $e) {
            $res =  array(
                'success' => false,
                'error' => $e->getMessage()
            );
            return $res;
        }
    }

    public function getData(){
        return $this->data;
    }

    public function getSuccess(){
        return $this->success;
    }
  }
?>