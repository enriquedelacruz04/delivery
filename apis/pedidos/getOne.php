<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$id = $_POST['id'];

try {

    //========================= Realizamos la consulta
    $consultaPedidos = "SELECT * FROM pedidos WHERE idPedidos = '$id'";
    $resultadoPedidos = mysqli_query($db, $consultaPedidos);
    $countPedidos = mysqli_num_rows($resultadoPedidos);

    if ($countPedidos > 0 && $resultadoPedidos) {
        $rowPedidos = mysqli_fetch_assoc($resultadoPedidos);

        $id = $rowPedidos['idPedidos'];
        $fecha = $rowPedidos['fecha'];
        $hora = $rowPedidos['hora'];
        $importe = $rowPedidos['importe'];
        $idClientes = $rowPedidos['idClientes'];
        $idRepartidores = $rowPedidos['idRepartidores'];

        $data = [
            "id" => utf8_encode($id),
            "fecha" => utf8_encode($fecha),
            "hora" => utf8_encode($hora),
            "importe" => utf8_encode($importe),
            "idClientes" => utf8_encode($idClientes),
            "idRepartidores" => utf8_encode($idRepartidores),
        ];

        //========================= Formamos el JSON
        $pedidos = [
            "ok" => true,
            "data" => $data,
        ];
    }

    //========================= Si hubo errores en la DB
    else {
        $pedidos = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $pedidos = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($pedidos);
