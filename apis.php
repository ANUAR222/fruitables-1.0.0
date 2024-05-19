<?php
header('Content-type: application/json; charset=utf-8');
$host = "localhost";
$user = "root";
$pass = "";
$db = "sabercomer";
$conexion = mysqli_connect($host, $user, $pass, $db);
if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*function editar() {
    var nombre = document.getElementById("nombre").value;
    var Category = document.getElementById("Category").value;
    var precio = document.getElementById("precio").value;
    var decripcion = document.getElementById("decripcion").value;
    //obten la id en la url
    id = window.location.search.split('=')[1];
    var data = {
        id: id,
        nombre: nombre,
        Category: Category,
        precio: precio,
        decripcion: decripcion
    };

    console.log(data); // Log the data to the console

    $.ajax({
        type: "POST",
        url: "apis.php?editar-plato",
        data: JSON.stringify(data), // Stringify the data object
        contentType: "application/json", // Set the content type to application/json
        success: function(data) {
            console.log(data);
        }
    });
}*/
header('Content-type: application/json; charset=utf-8');
$host = "localhost";
$user = "root";
$pass = "";
$db = "sabercomer";
$conexion = new mysqli($host, $user, $pass, $db);
session_start();
if ($conexion->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conexion->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['editarperfil'])) {
    // Obtener los datos del cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);
    $nombre = $input['nombre'];
    $correo = $input['correo'];
    $nacimiento = $input['nacimiento'];
    $direccion = $input['direccion'];
    $telefono = $input['telefono'];

    // Preparar la consulta SQL
    $sql = "UPDATE usuarios SET Nombre=?, Correo=?, Nacimiento=?, Direccion=?, Telefono=? WHERE id=?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $nombre, $correo, $nacimiento, $direccion, $telefono);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Update successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
    }
}

//login
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['login'])) {
    // Obtener los datos del cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'];
    $password = $input['password'];

    // Preparar la consulta SQL
    $sql = "SELECT * FROM usuario WHERE email=? AND contraseña=?";
    $stmt = $conexion->prepare($sql);


    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                $_SESSION['correo'] = $username;
                echo json_encode(array("success" => true, "data" => $user));
            } else {
                echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
    }
}
/*create table cliente
(
    id           int auto_increment
        primary key,
    id_usuario   int not null,
    id_datosPago int null,
    constraint cliente_ibfk_1
        foreign key (id_usuario) references usuario (id),
    constraint cliente_ibfk_2
        foreign key (id_datosPago) references datospago (id)
);create table usuario
(
    id         int auto_increment
        primary key,
    email      varchar(100) not null,
    contraseña varchar(100) not null,
    fecha_alta datetime     not null,
    fecha_baja datetime     null
);*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['registro'])) {
    // Get the data from the request body
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'];
    $email = $input['email'];
    $password = $input['password'];

    // Prepare the SQL query
    $sql = "INSERT INTO usuario (email, contraseña, fecha_alta) VALUES (?, ?, NOW())";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al registrar el usuario". $stmt->error));
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
    }
}





if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['editarplatos'])) {
    // Obtener los datos del cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);
    $stock = $input['stock'];
    $nombre = $input['nombre'];
    $category = $input['category'];
    $precio = $input['precio'];
    $descripcion = $input['descripcion'];
    $id = $input['id'];

    // Preparar la consulta SQL
    $sql = "UPDATE comidas SET Nombre=?, Precio=?, Ingredientes=? WHERE id=?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sdsi", $nombre, $precio, $descripcion, $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Update successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['añadirplatos'])) {
    // Obtener los datos del cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);
    $stock = $input['stock'];
    $nombre = $input['nombre'];
    $category = $input['category'];
    $precio = $input['precio'];
    $descripcion = $input['descripcion'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO comidas (Nombre, Precio, Ingredientes) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sds", $nombre, $precio, $descripcion);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Insert successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['eliminarplatos'])) {
    // Obtener los datos del cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    // Preparar la consulta SQL
    $sql = "DELETE FROM comidas WHERE id=?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Delete successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conexion->error]);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_GET['cerrar'])) {
    session_start();
    session_destroy();
    echo json_encode(["status" => "success", "message" => "Session closed"]);
}

$conexion->close();
?>