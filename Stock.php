<?php
require 'conexion.php';
require 'nav_bar_admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fruitables - Pedido Histórico</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Historial de Pedidos</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Historial de Pedidos</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Pedidos Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Pedidos pendientes</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de pedido</th>
                    <th scope="col">Actualizar Stock</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $conexion->prepare("SELECT * FROM pedido_stock INNER JOIN comidas ON pedido_stock.id_comida = comidas.id WHERE pedido_stock.estado='Pedido';");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['Nombre'] . '</td>';
                    echo '<td>' . $row['cantidad'] . '</td>';
                    echo '<td>' . $row['estado'] . '</td>';
                    echo '<td>' . $row['fecha'] . '</td>';
                    echo '<td><form action="actualizarStock.php" method="post">
                            <input type="hidden" name="id" value="' . $row['id_comida'] . '">
                            <input type="hidden" name="stock" value="' . $row['cantidad'] . '">
                            <button type="submit" class="btn btn-secondary">Marcar como recibido</button>
                        </form></td>';
                    echo '</tr>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Search End -->

