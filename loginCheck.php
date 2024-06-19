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
        //haz una consulta que te debueba si el usuario es jefe o no
        /*create table duenio
(
    id         int auto_increment
        primary key,
    id_usuario int          not null,
    DNI        varchar(9)   not null,
    Nombre     varchar(100) not null,
    Apellidos  varchar(100) not null,
    Telefono   varchar(15)  not null,
    constraint fk_due_usu
        foreign key (id_usuario) references usuario (id)
            on update cascade on delete cascade
)*/
        $sql = "SELECT * FROM duenio WHERE id_usuario=?";
        if ($user) {
            $_SESSION['id'] = $user['idUsuario'];
            $_SESSION['correo'] = $username;
            if ($admin) {
                header('Location: indexAdmin.php');
            }else if($stmt = $conexion->prepare($sql)){
                $stmt->bind_param("i", $user['idUsuario']);
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    $jefe = $result->fetch_assoc();
                    if($jefe){
                        header('Location: Modernize-1.0.0/src/html/index.php');
                    }else{
                        header('Location: index.php');
                    }
                }
            } else {
                header('Location: index.php');
            }
        } else {
            header('Location: login.php');
        }
    }
    $stmt->close();
}
