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
        $consultaRepartidores = "INSERT INTO repartidores
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

        $resultadoRepartidores = mysqli_query($db, $consultaRepartidores);
    } else {

        //========================= Realizamos la consulta
        $consultaRepartidores = "UPDATE repartidores SET 
        nombre = '$nombre',
        direccion = '$direccion',
        telefono = '$telefono'

        WHERE idRepartidores = '$edit'";

        $resultadoRepartidores = mysqli_query($db, $consultaRepartidores);
    }

    //========================= Formamos el JSON
    if ($resultadoRepartidores) {
        $repartidores = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $repartidores = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $repartidores = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($repartidores);
