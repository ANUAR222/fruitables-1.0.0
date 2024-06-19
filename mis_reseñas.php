<?php
global $conexion;
require 'nav_bar.php';
require 'conexion.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit;
}

// Obtener el ID del usuario
$correo = $_SESSION['correo'];
$sql = "SELECT id FROM usuario WHERE email = ?";
$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die('Error en prepare: ' . htmlspecialchars($conexion->error));
}
$stmt->bind_param("s", $correo);
if (!$stmt->execute()) {
    die('Error en execute: ' . htmlspecialchars($stmt->error));
}
$result = $stmt->get_result();
if (!$result) {
    die('Error en get_result: ' . htmlspecialchars($stmt->error));
}
$user = $result->fetch_assoc();
if (!$user) {
    die('No se encontró el usuario.');
}
$id_usuario = $user['id'];

// Consulta para obtener las reseñas del usuario
$sql = "SELECT v.id, c.Nombre AS comida_nombre, v.valoracion, v.Comentario 
        FROM valoracion v
        INNER JOIN comidas c ON v.id_comida = c.id 
        WHERE v.id_usuario = ?";
$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die('Error en prepare: ' . htmlspecialchars($conexion->error));
}
$stmt->bind_param("i", $id_usuario);
if (!$stmt->execute()) {
    die('Error en execute: ' . htmlspecialchars($stmt->error));
}
$reviews = $stmt->get_result();
if (!$reviews) {
    die('Error en get_result: ' . htmlspecialchars($stmt->error));
}
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
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <h1 class="text-primary display-6">Mis Reseñas</h1>
            <div class="reviews">
                <?php
                if ($reviews->num_rows > 0) {
                    echo "<p>Se encontraron " . $reviews->num_rows . " reseñas.</p>";
                    while ($review = $reviews->fetch_assoc()) {
                        echo '<div class="card mb-4">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($review['comida_nombre']) . '</h5>';
                        echo '<div class="d-flex mb-3">';
                        // Mostrar valoración con estrellas
                        for ($i = 0; $i < 5; $i++) {
                            echo '<i class="fa fa-star ' . ($i < $review['valoracion'] ? 'text-secondary' : '') . '"></i>';
                        }
                        echo '</div>';
                        echo '<p class="card-text">' . htmlspecialchars($review['Comentario']) . '</p>';
                        // Enlace para editar reseña
                        echo '<a href="editar_resena.php?id=' . $review['id'] . '" class="btn btn-primary">Editar Reseña</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No has realizado ninguna reseña aún.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
