<?php
require 'conexion.php';
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
    <title>Perfil de Usuario</title>
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
<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Adminsitracion de perfil</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header end -->

<form id="editar" action="gestionEditarPerfi.php" method="post" enctype="multipart/form-data">
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div id="prod_edit" class="row g-4">
                        <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT usuario.email as correo, cliente.nombre as Nombre FROM usuario INNER JOIN cliente ON usuario.id=cliente.id_usuario WHERE usuario.id = '$id'";
                        $result = $conexion->query($sql);
                        $row = $result->fetch_assoc();
                        $nombre = $row['Nombre'];
                        $correo = $row['correo'];
                        echo '<div class="col-lg-6">
                        <div class="border rounded p-4">
                            <h2>Nombre</h2>
                            <input type="text" class="form-control" name="nombre" value="'.$nombre.'">
                        </div>
                        <div class="border rounded p-4 mt-4">
                            <h2>Correo</h2>
                            <input type="text" class="form-control" name="correo" value="'.$correo.'">
                        </div>';
                        $conexion->close();
                        ?>
                        <!-- Botones de edición y eliminación -->
                        <button type="submit" id="editar" class="btn btn-warning rounded-pill px-4 py-2 mb-4"><i class="fa fa-edit me-2"></i> Editar</button>
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

