<?php

$db = mysqli_connect('localhost', 'root', 'root', 'dbdelivery');
// $db = mysqli_connect('localhost', 'id18077359_root', 'Sghi337mi...', 'id18077359_dbdelivery');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
} else {
    // echo "conexion correcta";
}
