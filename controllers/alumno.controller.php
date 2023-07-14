<?php

require_once "../models/Alumno.php";

if(isset($_POST['operacion'])){

    $alumno = new Alumno();

    if($_POST['operacion'] == 'buscar'){
        
        $resultado = [
            "status" => false,
            "mensaje" => "",
        ];

        $registro = $alumno->BuscarData($_POST['nromatricula'],$_POST['periodomatricula'],$_POST['apellidos']);

        if($registro){
            
            $resultado["status"] = true;
            $resutado["mensaje"] = "datos correctos";
            $resultado["datos"] = $registro;

        }else{
            $resultado["mensaje"] = "datos incorrectos";
        }

        echo json_encode($resultado);
    }
}