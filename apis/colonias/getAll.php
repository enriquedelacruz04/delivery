<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

try {

    //========================= Realizamos la consulta
    $consultaColonias = "SELECT * FROM colonias";
    $resultadoColonias = mysqli_query($db, $consultaColonias);
    $countColonias = mysqli_num_rows($resultadoColonias);

    if ($countColonias > 0 && $resultadoColonias) {
        while ($rowColonias = mysqli_fetch_assoc($resultadoColonias)) {

            $id = $rowColonias['idColonias'];
            $nombre = $rowColonias['nombre'];
            $codigoPostal = $rowColonias['codigoPostal'];
            $idRutas = $rowColonias['idRutas'];

            $data[] = [
                "id" => utf8_encode($id),
                "nombre" => utf8_encode($nombre),
                "codigoPostal" => utf8_encode($codigoPostal),
                "idRutas" => utf8_encode($idRutas),
            ];
        }

        //========================= Formamos el JSON
        $colonias = [
            "ok" => true,
            "data" => $data,
        ];

        //========================= Si la tabla esta vacia
    } else if ($countColonias == 0 && $resultadoColonias) {
        $colonias = [
            "ok" => true,
            "msg" => "Sin datos en la DB"
        ];

        //========================= Si hubo errores en la DB
    } else {
        $colonias = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $colonias = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($colonias);
