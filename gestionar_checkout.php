<?php
global $conexion;
require 'conexion.php';
session_start();

echo "<script>console.log('Pedido realizado con éxito')</script>";
// Obtener los datos del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);
$id_usuario = $_SESSION['id'];
$domicilio_entrega = $input['domicilio_entrega'];
$precio_total = $input['precio_total'];
$estado = "En preparación";
$fecha_pedido = date("Y-m-d H:i:s");
$fecha_entrega = date("Y-m-d H:i:s", strtotime("+1 day"));

// Preparar la consulta SQL
$sql = "INSERT INTO pedidos (ID_Cliente, Fecha_pedido, Fecha_entrega, Domicilio_entrega, Precio_total, Estado) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("isssds", $id_usuario, $fecha_pedido, $fecha_entrega, $domicilio_entrega, $precio_total, $estado);

    if ($stmt->execute()) {
        // Obtener el ID del pedido recién insertado
        $id_pedido = $stmt->insert_id;

        // Consulta para obtener los detalles del carrito
        $sql = "SELECT * FROM carrito WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($item = $result->fetch_assoc()) {
            // Insertar los detalles del carrito en la tabla comidas_de_pedidos
            $sql = "INSERT INTO comidas_de_pedidos (id_pedido, id_comida, cantidad) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iii", $id_pedido, $item['id_comida'], $item['cantidad']);
            $stmt->execute();
        }

        // Vaciar el carrito
        $sql = "DELETE FROM carrito WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        echo "<script>alert('Pedido realizado con éxito')</script>";
        echo json_encode(["status" => "success", "message" => "Order placed successfully"]);
    } else {
        echo json_encode(["status" => " error", "message" => "Error: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
}