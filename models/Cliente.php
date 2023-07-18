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
            $consulta->execute(array(

                $datos['emisor_ruc'],
                $datos['emisor_doc'],
                $datos['emisor_serie'],
                $datos['emisor_numero'],
                $datos['emisor_fecha'],
                $datos['cliente_ruc']
            ));

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }

        catch(Exception $e){
            die($e->getMessage());
        }
    }
}