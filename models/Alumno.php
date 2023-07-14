<?php

require_once "Conexion.php";

class Alumno extends Conexion{

    private $accesoBD;

    public function __construct()
    {
        $this->accesoBD = parent::getConexion();
    }

    public function BuscarData($nromatricula ="", $peridomatricula="", $apellidos=""){

        try{

            $consulta = $this->accesoBD->prepare("CALL spu_obtener_data(?,?,?)");
            $consulta->execute(array($nromatricula,$peridomatricula,$apellidos));

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }

        catch(Exception $e){
            die($e->getMessage());
        }
    }
}