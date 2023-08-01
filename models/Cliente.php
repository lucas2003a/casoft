<?php

require_once "Conexion.php";

class Cliente extends Conexion{

    private $accesoBD;

    public function __construct()
    {
        $this->accesoBD = parent::getConexion();
    }

    public function BuscarData($datos){

        try{

            $consulta = $this->accesoBD->prepare("CALL spu_buscardata(?,?,?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['emisor_ruc'],
                    $datos['emisor_doc'],
                    $datos['emisor_serie'],
                    $datos['emisor_numero'],
                    $datos['emisor_fecha'],
                    $datos['cliente_ruc']
                )
            );

            //si la consulta trae  todos los indices(columnas)
            return $consulta->fetch(PDO::FETCH_ASSOC);
            /*
            si la consulta solo trae un indice(una columna):
            return $consulta->fetch(PDO::FETCH_ASSOC)['file_zip'];
            */
        }

        catch(Exception $e){
            die($e->getMessage());
        }
    }
}