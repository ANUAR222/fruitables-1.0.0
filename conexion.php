<?php
$host = "complist.mysql.database.azure.com";
$user = "complist";
$pass = "ISI2023-2024";
$db = "sabercomer";
$conexion = mysqli_connect($host, $user, $pass, $db);
if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
}
?>