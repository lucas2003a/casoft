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
        
        //si la consulta retorna todos los indices(columnas en la base de datos)
        /*consulta en la base de datos: 
        drop procedure if exists spu_buscardata;
        delimiter $$
        create procedure spu_buscardata
        (
        in emisor_ruc_   varchar(11),
        in emisor_doc_   varchar(2),
        in emisor_serie_ varchar(4),
        in emisor_numero_ varchar(20),
        in emisor_fecha_ date,
        in cliente_ruc_  varchar(11)
        )
        begin
        select * from comprobantes
        where  emisor_ruc = emisor_ruc_
            and  emisor_doc = emisor_doc_
            and  emisor_serie = emisor_serie_
            and  emisor_numero = emisor_numero_
            and  emisor_fecha = emisor_fecha_
            and  cliente_ruc = cliente_ruc_;
        end$$

        delimiter ;

        call spu_buscardata('20606177896','01','f001','7247','2023-07-11','20534830549'); 
        */
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

            $ruc_emi = $registro['emisor_ruc'];
            $doc_tipo = $registro['emisor_doc'];
            $doc_serie = $registro['emisor_serie'];
            $doc_numero = $registro['emisor_numero'];
            $file_name = $ruc_emi . "-" . $doc_tipo . "-" . $doc_serie . "-" . $doc_numero;
            if($resultado['status']){
                $resultado['mensaje'] = "Registro encontrado";

                //Archivo file_zip de la base de datos

                if(isset($registro['file_zip']) && $registro['file_zip']){

                    //Aquí realizamos la decarga del archivo en formato base64
                    $base64_file_data = $registro['file_zip'];

                    //Configurar los encabezados para que el navegador descargue el archivo
                    header('Content-Description: File transfer');
                    header('Content-Disposition: atachment; filename= "probando decarga.zip"');
                    header('Content-Type: application/ctet-stream'); //application/octet-stream = archivo binario
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length' .strlen($base64_file_data));

                    //Decodificar enviar el archivo base64 al navegador
                    $url = "../files/".$file_name.".zip";
                    $cdata = hex2bin($base64_file_data);

                    file_put_contents($url,$cdata);

                    clearstatcache();

                    //Define header information
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.basename($url).'"');
                    header('Content-Length: ' . filesize($url));
                    header('Pragma: public');

                    //Clear system output buffer
                    flush();

                    //Read the size of the file
                    readfile($url,true);

                    //Terminate from the script
                    die();

                    
                    readfile($url, true);

                    //Terminar la ejecución del script después de la descarga
                    exit();

                }
            }
        }else{

            $resultado['mensaje'] = "No existe el  registro";
        }

        
        echo json_encode($resultado);
    }

}

