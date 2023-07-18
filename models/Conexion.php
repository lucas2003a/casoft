<?php

class Conexion{

    private $host= "198.74.122.149";
    private $port = "3306";
    private $database = "efactura";
    private $charset = "UTF8";
    private $user = "casoftsystemweb";
    private $password = "16071970";

    private $pdo;

    private function conectarServidor(){

        $conexion = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}",$this->user,$this->password);
        return $conexion;
    }
    
    public function getConexion(){

        try{

            $this->pdo = $this->conectarServidor();

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        }

        catch(Exception $e){
            die($e->getMessage());
        }
    }
}