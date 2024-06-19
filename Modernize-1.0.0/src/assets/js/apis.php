<?php
$host = "complist.mysql.database.azure.com";
$user = "complist";
$db_password = "ISI2023-2024";
$db = "sabercomer";
$conexion = new mysqli($host, $user, $db_password, $db);
if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['ventas_por_mes'])) {
    $sql = "SELECT MONTH(Fecha_pedido) as month, SUM(Precio_total) as total FROM pedidos where YEAR(Fecha_pedido) = YEAR(CURDATE()) GROUP BY MONTH(Fecha_pedido)";
    $result = $conexion->query($sql);
    if ($result === false) {
        // La consulta SQL falló, maneja el error aquí
        echo json_encode(["status" => "error", "message" => "La consulta SQL falló: " . $conexion->error]);
    } else {
        // Inicializa el array $sales con todos los meses del año y asigna un valor inicial de 0
        $sales = array_fill(1, 12, 0);
        while ($row = $result->fetch_assoc()) {
            // Actualiza los valores de los meses que tienen ventas
            $sales[intval($row['month'])] = $row['total'];
        }
        echo json_encode(["status" => "success", "sales" => $sales]);
    }
}
/*function obtener_ventas_de_los_ultimos_3_anos(){
    return promise = new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/fruitables-1.0.0/vista_de_jefe/Modernize-1.0.0/src/assets/js/apis.php?", true);
        xhr.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                console.log('Success:', xhr.response);
                var data = JSON.parse(xhr.response);
                var sales = data.sales;
                var salesData = Object.values(sales).map(Number);
                resolve(salesData);
            } else {
                console.error('Error:', {status: this.status, statusText: xhr.statusText});
                resolve([]); // Resolves to an empty array in case of error
            }
        };
        xhr.onerror = function () {
            console.error('Error:', {status: this.status, statusText: xhr.statusText});
            resolve([]); // Resolves to an empty array in case of error
        };
        xhr.send();
    })
  }*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['ventas_por_anio'])) {
    $sql = "SELECT YEAR(Fecha_pedido) as year, SUM(Precio_total) as total FROM pedidos GROUP BY YEAR(Fecha_pedido)";
    $result = $conexion->query($sql);
    if ($result === false) {
        // La consulta SQL falló, maneja el error aquí
        echo json_encode(["status" => "error", "message" => "La consulta SQL falló: " . $conexion->error]);
    } else {
        $sales = [];
        while ($row = $result->fetch_assoc()) {
            $sales[$row['year']] = $row['total'];
        }
        echo json_encode(["status" => "success", "sales" => $sales]);
    }
}
//usuarios por mes
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['usuarios_por_mes'])) {
    $sql = "SELECT MONTH(fecha_alta) as month, COUNT(*) as total FROM usuario GROUP BY MONTH(fecha_alta)";
    $result = $conexion->query($sql);
    if ($result === false) {
        // La consulta SQL falló, maneja el error aquí
        echo json_encode(["status" => "error", "message" => "La consulta SQL falló: " . $conexion->error]);
    } else {
        $users = array_fill(1, 12, 0);
        while ($row = $result->fetch_assoc()) {
            $users[intval($row['month'])] = $row['total'];
        }
        echo json_encode(["status" => "success", "users" => $users]);
    }
}
//funcion para el logaout
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['logout'])) {
    session_start();
    session_destroy();
    echo json_encode(["status" => "success", "message" => "Sesión cerrada"]);
}
?>