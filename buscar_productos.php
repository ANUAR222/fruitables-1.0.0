<?php
if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $host = "complist.mysql.database.azure.com";
    $user = "complist";
    $db_password = "ISI2023-2024";
    $db = "sabercomer";
    // Conexión a la base de datos
    $conexion = new mysqli($host, $user, $db_password, $db);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta a la base de datos
    $sql = "SELECT * FROM comidas WHERE Nombre LIKE '%$query%'";
    $result = $conexion->query($sql);

    // Generar la respuesta
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row['Nombre'] . '</li>';
        }
    } else {
        echo 'No se encontraron productos';
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
