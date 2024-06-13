<?php
require 'conexion.php';
session_start();
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$id = $_SESSION['id'];
$stmt = $conexion->prepare("UPDATE cliente SET nombre=? WHERE id_usuario=?");
$stmt->bind_param("si", $nombre, $id);
$stmt->execute();
$stmt->close();
$stmt = $conexion->prepare("UPDATE usuario SET email=? WHERE id=?");
$stmt->bind_param("si", $correo, $id);
$stmt->execute();
$stmt->close();
$conexion->close();
header('Location: perfil.php');
