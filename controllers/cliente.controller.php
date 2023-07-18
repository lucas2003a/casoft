<?php

require_once '../models/Cliente.php';

if(isset($_POST['operacion'])){

    $cliente = new Cliente();

    if($_POST['operacion'] == 'buscar'){
        
        $resultado =[

            "status" =>false,
            "mensaje" => "",
            "datos" => array()
        ];

        $datos = [

            'emisor_ruc'    => $_POST['emisor_ruc'],
            'emisor_doc'    => $_POST['emisor_doc'],
            'emisor_serie'  => $_POST['emisor_serie'],
            'emisor_numero' => $_POST['emisor_numero'],
            'emisor_fecha'  => $_POST['emisor_fecha'],
            'cliente_ruc'   => $_POST['cliente_ruc']
        ];
        /*
        otra opcion de crear arrays:
                 $datos = array()
                 $datos = []
        $resultado =array(

            "status" =>false,
            "mensaje" => "",
        );

        $datos = array(

            'emisor_ruc'    => $_POST['emisor_ruc'],
            'emisor_doc'    => $_POST['emisor_doc'],
            'emisor_serie'  => $_POST['emisor_serie'],
            'emisor_numero' => $_POST['emisor_numero'],
            'emisor_fecha'  => $_POST['emisor_fecha'],
            'cliente_ruc'   => $_POST['cliente_ruc']
        );
        */
    
        $registro = $cliente->BuscarData($datos);

        if($registro){
            /*
            1.-if($registro['emisor_ruc']) utilizando esta estructura condicional directa solo evalua que exista el contenido, pero no evalua que exista la llave 'emiso_ruc', esto puede generar un error "UndefinedIndex", si no existe la llave.
            las llaves, en el id y name del html, en el controlador y el modelo, los campos de la base de datos, deben ser los mismos para no tener errores de sintaxis, ya que con estas llaves identificas al campo de la tabla del cual deseas acceder el valor.

            2.-if(isset($registro['emisor_ruc])&& $resultado['nromatricula']) utilizando isset, verifica que primero exista la llave en el array, luego verifica la existencia del contnido de la base de datos, esta estructura nos  ayuda a controlar el error "UndefinedIndex",

            3.-if(array_key_exist('emisor_doc',$registro) && $registro['emisro_doc']) utilizando arrary_key_exist, verifica que primero exista la llave en el array, luego verifica la existencia del contnido de la base de datos, esta estructura nos  ayuda a controlar el error "UndefinedIndex",
            */
            if(isset($registro['emisor_ruc']) && $registro['emisor_ruc']){
                $resultado['datos']['emisor_ruc'] = $registro['emisor_ruc'];
                $resultado['status'] = true;
            }else{
                $resultado['mensaje'] .= "no existe el ruc de emisor nº:" .$registro['emisor_ruc'].".";
            }

            if(isset($registro['emisor_doc']) && $registro['emisor_doc']){
                $resultado['datos']['emisor_doc'] = $registro['emisor_doc'];
                $resultado['status'] = true;
            }else{
                $resultado['mensaje'] .= "no existe el tipo de documento:" .$registro['emisor_doc'];
            }

            if(isset($registro['emisor_serie']) && $registro['emisor_serie']){
                $resultado['datos']['emisor_serie'] = $registro['emisor_serie'];
                $resultado['status'] = true;
            }else{
                $resultado['mensaje'] .= "no existe el número de serie:";
            }

            if(isset($registro['emisor_numero']) && $registro['emisor_numero']){
                $resultado['datos']['emisor_numero'] = $registro['emisor_numero'];
                $resultado['status'] = true;
            }else{
                $resultado['mensaje'] .= "no se encontró el número de serie:" .$registro['emisor_numero'];
            }

            if(isset($registro['emisor_fecha']) && $registro['emisor_fecha']){
                $resultado['datos']['emisor_fecha'] = $registro['emisor_fecha'];
                $resultado['status'] = true;
            }else{
                $resultado['mensaje'] .= "no se encontró la  fecha:" .$registro['emisor_fecha'];
            }

            if(isset($registro['cliente_ruc']) && $registro['cliente_ruc']){
                $resultado['datos']['cliente_ruc'] = $registro['cliente_ruc'];
                $resultado['status'] = true;
            }else{
                $resultado['mensaje'] .= "no existe el ruc del cliente:" .$registro['cliente_ruc'];
            }

            if($resultado['status']){
                $resultado['mensaje'] = "Registro encontrado";
            }
        }else{

            $resultado['mensaje'] = "No existe el  registro";
        }

        
        echo json_encode($resultado);
    }

}