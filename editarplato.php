<?php
require 'nav_bar.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <h1 class="text-center text-white display-6">Adminsitracion de platos</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>

<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div id="prod_edit" class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="img/single-item.jpg" class="img-fluid rounded" alt="Image">

                            </a>
                        </div>
                    </div>
                    <!-- create table comidas
(
    id               int auto_increment
        primary key,
    Nombre           varchar(100)                             not null,
    Precio           decimal(10, 2)                           not null,
    Peso             decimal(10, 2)                           not null,
    Calorías         int                                      null,
    Ingredientes     text                                     null,
    Valoración_media decimal(3, 2)                            null,
    Tipo             enum ('Entrante', 'Principal', 'Postre') not null
); -->
                    <div class="col-lg-6">
                        <div class="border rounded p-4">
                            <h2 class="mb-4">Editar Plato</h2>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="mb-3">
                                <label for="Category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="Category" placeholder="Category">
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precio" placeholder="Precio">
                            </div>
                            <div class="mb-3">
                                <label for="decripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="decripcion" rows="3" placeholder="Descripción"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stok" placeholder="Stock">
                            </div>
                        </div>
                        <!-- Botones de edición y eliminación -->
                        <a id="editar" onclick="editar()" class="btn btn-warning rounded-pill px-4 py-2 mb-4"><i class="fa fa-edit me-2"></i> Editar</a>
                        <a onclick="aniadir()" class="btn  btn-warning rounded-pill px-4 py-2 mb-4"><i class="fa fa-trash me-2"></i> añadir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
    window.onload = function() {
        var id = window.location.search.split('=')[1];
        if (id == null) {
            document.getElementById("editar").style.display = "none";
        }
    }

    function aniadir() {
        var nombre = document.getElementById("nombre").value;
        var category = document.getElementById("Category").value;
        var precio = document.getElementById("precio").value;
        var descripcion = document.getElementById("decripcion").value;
        var stock = document.getElementById("stok").value;

        var data = {
            nombre: nombre,
            category: category,
            precio: precio,
            descripcion: descripcion,
            stock: stock
        };

        console.log(data);

        $.ajax({
            type: "POST",
            url: "apis.php?añadirplatos",
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function(response) {
                console.log(response);
                window.location.href = "adminstracion_platos.php";
            }
        });
    }


    function editar() {
        var nombre = document.getElementById("nombre").value;
        var category = document.getElementById("Category").value; // Cambié 'Category' a minúscula
        var precio = document.getElementById("precio").value;
        var descripcion = document.getElementById("decripcion").value; // Cambié 'decripcion' a 'descripcion'
        var stock = document.getElementById("stok").value;
        // Obtén la id en la URL
        var id = window.location.search.split('=')[1];

        var data = {
            id: id,
            nombre: nombre,
            category: category, // Cambié 'Category' a 'category'
            precio: precio,
            descripcion: descripcion, // Cambié 'decripcion' a 'descripcion'
            stock: stock
        };

        console.log(data); // Log the data to the console

        $.ajax({
            type: "POST",
            url: "apis.php?editarplatos",
            data: JSON.stringify(data), // Stringify the data object
            contentType: "application/json", // Set the content type to application/json
            success: function(response) {
                console.log(response);
                window.location.href = "adminstracion_platos.php";
            }
        });
    }

</script>
</body>

</html>