<?php
require 'conexion.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Preparar la consulta SQL
$sql = "SELECT usuario.id as idUsuario, usuario.email as correo,adiministrador.id_usuario as id_usuario FROM usuario LEFT JOIN adiministrador ON usuario.id=adiministrador.id_usuario WHERE usuario.email=? AND usuario.contraseña=?";
$stmt = $conexion->prepare($sql);


if ($stmt) {
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $admin = $user['id_usuario'];
        if ($user) {
            $_SESSION['id'] = $user['idUsuario'];
            $_SESSION['correo'] = $username;
            if ($admin) {
                header('Location: indexAdmin.php');
            } else {
                header('Location: index.php');
            }
        } else {
            header('Location: login.php');
        }
    }
    $stmt->close();
}
