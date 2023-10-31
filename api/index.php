<?php
// IMPORTACION DE ARCHIVOS PHP //
    include ("utilidades/API_CLASS.php");

// CONEXION //
    $server = "localhost";
    $username = "root"; 
    $dbname = "api_rn";
    $password = "";
    $conexion = new BaseDeDatos($server, $username, $dbname, $password);

// CONFIGURACION ENCABEZADO PARA ESTABLECER QUE EL CONTENIDO VA A SER TYPO JSON //
    header("content-type: application/json");

// CATCH DE LOS METHODOS QUE ESTAN SIENDO ENVIADOS //
    $metodos = $_SERVER['REQUEST_METHOD'];
    print_r($metodos . ' ');// ESTO ESTA PARA CONFIRMAR QUE FUNCIONA

// OBJETO DE LA CLASE API //
    $api= new API($conexion);

    switch ($metodos){//reconocimiento y manejo de los tipos de metodos
        case 'GET':
            $api->endpointObtener();
            break;
        case 'POST':
            $token = bin2hex(random_bytes(16));
            $api->endpointCrear($token);
            break;
        case 'PUT':
            $token = bin2hex(random_bytes(16));
            $api->endpointActualizar($token);
            break;
        case 'DELETE':
            $api->endpointBorrar();
            break;
        default:
            echo('Error, metodo no reconocido');
            break;
    }

?>
