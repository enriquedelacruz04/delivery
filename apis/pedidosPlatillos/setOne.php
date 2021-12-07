<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

//========================= Importamos la conexion
require '../includes/conexion.php';

//========================= Parametros que nos llegan por POST
$nombre = utf8_decode($_POST['nombre']);
$idPedidos = utf8_decode($_POST['idPedidos']);
$idPlatillos = utf8_decode($_POST['idPlatillos']);
$edit = utf8_decode($_POST['edit']);

try {
    if ($edit == '0') {

        //========================= Realizamos la consulta
        $consultaPedidosPlatillos = "INSERT INTO pedidosPlatillos
        (
        idPedidos,
        idPlatillos
        )
        VALUES 
        (
        '$idPedidos',
        '$idPlatillos'
        )";

        $resultadoPedidosPlatillos = mysqli_query($db, $consultaPedidosPlatillos);
    } else {

        //========================= Realizamos la consulta
        $consultaPedidosPlatillos = "UPDATE pedidosPlatillos SET 
        idPedidos = '$idPedidos',
        idPlatillos = '$idPlatillos'

        WHERE idPedidosPlatillos = '$edit'";

        $resultadoPedidosPlatillos = mysqli_query($db, $consultaPedidosPlatillos);
    }

    //========================= Formamos el JSON
    if ($resultadoPedidosPlatillos) {
        $pedidosPlatillos = [
            "ok" => true,
        ];

        //========================= Si hubo errores en la DB
    } else {
        $pedidosPlatillos = [
            "ok" => false,
            "msg" => "Error en la DB"
        ];
    }
} catch (\Throwable $th) {
    throw $th;
    var_dump($th);

    $pedidosPlatillos = [
        "ok" => false,
        "msg" => "Error en la DB"
    ];
}

//========================= Imprimimos el JSON
echo json_encode($pedidosPlatillos);
