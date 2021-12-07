<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$id = $_POST['id'];

try {

    //========================= Realizamos la consulta
    $consultaRepartidores = "SELECT * FROM repartidores WHERE idRepartidores = '$id'";
    $resultadoRepartidores = mysqli_query($db, $consultaRepartidores);
    $countRepartidores = mysqli_num_rows($resultadoRepartidores);

    if ($countRepartidores > 0 && $resultadoRepartidores) {
        $rowRepartidores = mysqli_fetch_assoc($resultadoRepartidores);

        $id = $rowRepartidores['idRepartidores'];
        $nombre = $rowRepartidores['nombre'];
        $direccion = $rowRepartidores['direccion'];
        $telefono = $rowRepartidores['telefono'];

        $data = [
            "id" => utf8_encode($id),
            "nombre" => utf8_encode($nombre),
            "direccion" => utf8_encode($direccion),
            "telefono" => utf8_encode($telefono),
        ];

        //========================= Formamos el JSON
        $repartidores = [
            "ok" => true,
            "data" => $data,
        ];
    }

    //========================= Si hubo errores en la DB
    else {
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
