<?php
class Inventarioportienda{
    private $conexion;
    private $data;
    private $success;
    private $errorConexion;


    public function __construct(){
        $db = new db();
        $conexion=$db->conectDB();
        if (!$conexion['success']) {
            $this->errorConexion = true;
            $this->conexion = $conexion['error'];
        } else {
            $this->errorConexion = false;
            $this->conexion = $conexion['instance'];
        }
        $this->data = null;
        $this->success = null;

    }

    public function filterByProduct($product){
        if ($this->errorConexion) {
            return $this->conexion;
        } else {
            try {
                // consulta a la base
                $sql = "SELECT id_tienda, cantidad_existente, cantidad_inicial FROM inventarioportienda 
                  WHERE id_inventario = $product;";
                // respuesta del modelo
                $resultado = $this->conexion->query($sql);
                $this->data = responseModels($resultado);
                $res =  array(
                    'success' => true
                );
                return $res;
            } catch (PDOException $e) {
                $res =  array(
                    'success' => false,
                    'error' => $e->getMessage()
                );
                return $res;
            }
        }
        
    }

    public function getAll(){
        if ($this->errorConexion) {
            return $this->conexion;
        } else {
            try {
                // consulta a la base
                $sql = "SELECT * FROM inventarioportienda;";
                // respuesta del modelo
                $resultado = $this->conexion->query($sql);
                $this->data = responseModels($resultado);
                $res =  array(
                    'success' => true
                );
                return $res;
            } catch (PDOException $e) {
                $res =  array(
                    'success' => false,
                    'error' => $e->getMessage()
                );
                return $res;
            }
        }
    }

    public function updateInventary($value, $product, $store){
        if ($this->errorConexion) {
            return $this->conexion;
        } else {
            try {
                // consulta a la base
                $sql = "UPDATE inventarioportienda
                SET cantidad_existente=$value
                WHERE id_inventario = $product AND id_tienda=$store;";
                // respuesta del modelo
                $resultado = $this->conexion->query($sql);
                $this->success = $resultado->queryString == $sql;
                $res =  array(
                    'success' => true
                );
                return $res;
            } catch (PDOException $e) {
                $res =  array(
                    'success' => false,
                    'error' => $e->getMessage()
                );
                return $res;
            }
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