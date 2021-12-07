<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

try {

    //========================= Realizamos la consulta
    $consultaRepartidores = "SELECT * FROM repartidores";
    $resultadoRepartidores = mysqli_query($db, $consultaRepartidores);
    $countRepartidores = mysqli_num_rows($resultadoRepartidores);

    if ($countRepartidores > 0 && $resultadoRepartidores) {
        while ($rowRepartidores = mysqli_fetch_assoc($resultadoRepartidores)) {

            $id = $rowRepartidores['idRepartidores'];
            $nombre = $rowRepartidores['nombre'];
            $direccion = $rowRepartidores['direccion'];
            $telefono = $rowRepartidores['telefono'];

            $data[] = [
                "id" => utf8_encode($id),
                "nombre" => utf8_encode($nombre),
                "direccion" => utf8_encode($direccion),
                "telefono" => utf8_encode($telefono),
            ];
        }

        //========================= Formamos el JSON
        $repartidores = [
            "ok" => true,
            "data" => $data,
        ];

        //========================= Si la tabla esta vacia
    } else if ($countRepartidores == 0 && $resultadoRepartidores) {
        $repartidores = [
            "ok" => true,
            "msg" => "Sin datos en la DB"
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
