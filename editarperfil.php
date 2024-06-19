<?php
require 'conexion.php';
require 'nav_bar.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        #imagen {
            width: 100%;
            height: 100%;
        }
    </style>
    <meta charset="utf-8">
    <title>Editar Perfil</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
    <h1 class="text-center text-white display-6">Administración de perfil</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Editar Perfil</li>
    </ol>
</div>
<!-- Single Page Header end -->

<form id="editarPerfilForm" action="gestionEditarPerfil.php" method="post">
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div id="prod_edit" class="row g-4">
                        <?php
                        // Fetch user details from 'usuario', 'cliente', and 'datospago' tables
                        $id = $_SESSION['id'];
                        $sql = "SELECT u.email as correo, c.nombre as Nombre, d.Domicilio, d.Número_tarjeta, d.Teléfono, d.CVV, d.Fecha_caducidad
                                    FROM usuario u
                                    INNER JOIN cliente c ON u.id = c.id_usuario
                                    INNER JOIN datospago d ON c.id_datosPago = d.id
                                    WHERE u.id = ?";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        $nombre = $row['Nombre'];
                        $correo = $row['correo'];
                        $domicilio = $row['Domicilio'];
                        $num_tarjeta = $row['Número_tarjeta'];
                        $telefono = $row['Teléfono'];
                        $cvv = $row['CVV'];
                        $fecha_caducidad = $row['Fecha_caducidad'];

                        // Display inputs for editing
                        echo '
                            <div class="col-lg-6">
                                <div class="border rounded p-4">
                                    <h2>Nombre</h2>
                                    <input type="text" class="form-control" name="nombre" value="'.$nombre.'" required>
                                </div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>Correo</h2>
                                    <input type="email" class="form-control" name="correo" value="'.$correo.'" required>
                                </div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>Domicilio</h2>
                                    <input type="text" class="form-control" name="domicilio" value="'.$domicilio.'" required>
                                </div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>Número de Tarjeta</h2>
                                    <input type="text" class="form-control" name="num_tarjeta" value="'.$num_tarjeta.'" required>
                                </div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>Teléfono</h2>
                                    <input type="text" class="form-control" name="telefono" value="'.$telefono.'" required>
                                </div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>CVV</h2>
                                    <input type="text" class="form-control" name="cvv" value="'.$cvv.'" required>
                                </div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>Fecha de Caducidad</h2>
                                    <input type="date" class="form-control" name="fecha_caducidad" value="'.$fecha_caducidad.'" required>
                                </div>
                            </div>';

                        $conexion->close();
                        ?>
                        <!-- Submit Button -->
                        <button type="submit" id="editar" class="btn btn-warning rounded-pill px-4 py-2 mt-4"><i class="fa fa-edit me-2"></i> Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

</body>

</html>
