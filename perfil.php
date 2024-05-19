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
    <!-- Aquí va el código HTML para la estructura de la página de perfil de usuario -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <h1 class="text-primary display-6">Perfil de Usuario</h1>
                <div class="profile-info">
                    <?php
                    echo '<h2 id="Nombre">Nombre de Usuario</h2> 
                    <p id="Correo">Correo</p>'.$_SESSION['correo'].' 
                    <p id="nacimiento">Fecha de Nacimiento</p>
                    <p id="Dirección">Dirección</p>
                    <p id="Teléfono">Teléfono</p>'
                    ?>
                </div>
            </div>
        </div>
        <!-- Aquí va el código HTML para con botones de edición y eliminación -->
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <a href="adminstracion_platos.php" class="btn btn-primary">Adminsitrar comida</a>
                <a id="editar" onclick="editarperfil()" class="btn btn-primary">Editar Perfil</a>
                <a onclick="cerrar_sesiso()"  class="btn btn-danger">Cerrar Sesion</a>
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
        <script>//cambia los datos por inputs
            function replaceWithInput(id, value) {
    document.getElementById(id).innerHTML = `<input type="text" id="${id}" value="${value}">`;
}

function cerrar_sesiso() {
    $.ajax({
        type: "POST",
        url: "apis.php?cerrar",
        data: {
            cerrar_sesion: true
        },
        success: function(data) {
            console.log(data);
            window.location.href = "login.php";
        }
    });
            }
function editarperfil() {
    ['Nombre', 'Correo', 'nacimiento', 'Dirección', 'Teléfono'].forEach(id => {
        replaceWithInput(id, document.getElementById(id).innerHTML);
    });

    document.getElementById("editar").innerHTML = '<button onclick="editar_perfil2()" class="btn btn-primary">Guardar</button>';
}
            function editar_perfil2() {
                var nombre = document.getElementById("Nombre").value;
                var correo = document.getElementById("Correo").value;
                var nacimiento = document.getElementById("nacimiento").value;
                var direccion = document.getElementById("Dirección").value;
                var telefono = document.getElementById("Teléfono").value;
                $.ajax({
                    type: "POST",
                    url: "apis.php",
                    data: {
                        nombre: nombre,
                        correo: correo,
                        nacimiento: nacimiento,
                        direccion: direccion,
                        telefono: telefono
                    },
                    success: function(data) {
                        alert(data);
                    }
                });

            }
        </script>
</body>

</html>