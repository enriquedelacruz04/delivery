<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$nombre = utf8_decode($_POST['nombre']);
$idRepartidores = utf8_decode($_POST['idRepartidores']);
$edit = utf8_decode($_POST['edit']);

try {
    if ($edit == '0') {

        //========================= Realizamos la consulta
        $consultaRutas = "INSERT INTO rutas
        (
        nombre,
        idRepartidores
        )
        VALUES 
        (
        '$nombre',
        '$idRepartidores'
        )";

        $resultadoRutas = mysqli_query($db, $consultaRutas);
    } else {

        //========================= Realizamos la consulta
        $consultaRutas = "UPDATE rutas SET 
        nombre = '$nombre',
        idRepartidores = '$idRepartidores'

        WHERE idRutas = '$edit'";

        $resultadoRutas = mysqli_query($db, $consultaRutas);
    }

    //========================= Formamos el JSON
    if ($resultadoRutas) {
        $rutas = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $rutas = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $rutas = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($rutas);
