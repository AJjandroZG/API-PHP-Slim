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

    public function filterByProduct($product){
        // consulta a la base
        $sql = "SELECT id_tienda, cantidad_existente, cantidad_inicial FROM inventarioportienda 
          WHERE id_inventario = $product;";
        // respuesta del modelo
        $resultado = $this->conexion->query($sql);
        $this->data = responseModels($resultado);
    }

    public function getAll(){
        // consulta a la base
        $sql = "SELECT * FROM inventarioportienda;";
        // respuesta del modelo
        $resultado = $this->conexion->query($sql);
        $this->data = responseModels($resultado);
    }

    public function updateInventary($value, $product, $store){
        // consulta a la base
        $sql = "UPDATE inventarioportienda
        SET cantidad_existente=$value
        WHERE id_inventario = $product AND id_tienda=$store;";
        // respuesta del modelo
        $resultado = $this->conexion->query($sql);
        $this->success = $resultado->queryString == $sql;
    }

    public function getData(){
        return $this->data;
    }

    public function getSuccess(){
        return $this->success;
    }
  }
?>