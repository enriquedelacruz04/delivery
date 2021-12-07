<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$id = $_POST['id'];

try {

    //========================= Realizamos la consulta
    $consultaClientes = "SELECT * FROM clientes WHERE idClientes = '$id'";
    $resultadoClientes = mysqli_query($db, $consultaClientes);
    $countClientes = mysqli_num_rows($resultadoClientes);

    if ($countClientes > 0 && $resultadoClientes) {
        $rowClientes = mysqli_fetch_assoc($resultadoClientes);

        $id = $rowClientes['idClientes'];
        $nombre = $rowClientes['nombre'];
        $direccion = $rowClientes['direccion'];
        $telefono = $rowClientes['telefono'];

        $data = [
            "id" => utf8_encode($id),
            "nombre" => utf8_encode($nombre),
            "direccion" => utf8_encode($direccion),
            "telefono" => utf8_encode($telefono),
        ];

        //========================= Formamos el JSON
        $clientes = [
            "ok" => true,
            "data" => $data,
        ];
    }

    //========================= Si hubo errores en la DB
    else {
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
