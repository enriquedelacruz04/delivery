<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$nombre = utf8_decode($_POST['nombre']);
$direccion = utf8_decode($_POST['direccion']);
$telefono = utf8_decode($_POST['telefono']);
$edit = utf8_decode($_POST['edit']);

try {
    if ($edit == '0') {

        //========================= Realizamos la consulta
        $consultaClientes = "INSERT INTO clientes
        (
        nombre,
        direccion,
        telefono
        )
        VALUES 
        (
        '$nombre',
        '$direccion',
        '$telefono'
        )";

        $resultadoClientes = mysqli_query($db, $consultaClientes);
    } else {

        //========================= Realizamos la consulta
        $consultaClientes = "UPDATE clientes SET 
        nombre = '$nombre',
        direccion = '$direccion',
        telefono = '$telefono'

        WHERE idClientes = '$edit'";

        $resultadoClientes = mysqli_query($db, $consultaClientes);
    }

    //========================= Formamos el JSON
    if ($resultadoClientes) {
        $clientes = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $clientes = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $clientes = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($clientes);
