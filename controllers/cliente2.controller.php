<?php

require_once '../models/Cliente.php';

if(isset($_POST['operacion'])){

    $cliente = new Cliente();

    if($_POST['operacion'] == 'buscar'){

        $resultado = [
            
            'status' => false,
            'mensaje'=> "",
            'datos' =>[],
        ];

        $datos = [

            'emisor_ruc'    => $_POST['emisor_ruc'],
            'emisor_doc'    => $_POST['emisor_doc'],
            'emisor_serie'  => $_POST['emisor_serie'],
            'emisor_numero' => $_POST['emisor_numero'],
            'emisor_fecha'  => $_POST['emisor_fecha'],
            'cliente_ruc'   => $_POST['cliente_ruc']
        ];

        $registro = $cliente->BuscarData($datos);

        if($registro){

            $resultado['status'] = true;
            $resultado['mensaje'] = "Se encontró el archivo";
            $resultado['datos']['file_zip'] = $registro;

            header('Content-Description: File transfer');
            header('content-Disposition: atachmente; filename= "probando descarfa"');
            header('Content-Type: application/octet-strem');
            header('Conten-Transfer-Encoding: binary');
            header('Content-Length' .strlen($registro));

            echo base64_decode($registro);

            exit();

        }else{
            $resultado['mensaje'] = "No existe el archivo";
        }
    }
}