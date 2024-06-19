
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../../index.php');
    exit;
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
      <aside class="left-sidebar">
          <!-- Sidebar scroll-->
          <div>
              <div class="brand-logo d-flex align-items-center justify-content-between">
                  <a href="index.php" class="text-nowrap logo-img">
                      <img src="../assets/images/logos/dark-logo.svg" width="180" alt=""/>
                  </a>
                  <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                      <i class="ti ti-x fs-8"></i>
                  </div>
              </div>
              <!-- Sidebar navigation-->
              <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                  <ul id="sidebarnav">
                      <li class="nav-small-cap">
                          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                          <span class="hide-menu">Home</span>
                      </li>
                      <li class="sidebar-item">
                          <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                              <span class="hide-menu">Dashboard</span>
                          </a>
                      </li>
                      <li class="sidebar-item">
                          <a class="sidebar-link" href="sample-page.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                              <span class="hide-menu">Envia Mensajes</span>
                          </a>
                      </li>

                      <li class="nav-small-cap">
                          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                          <span class="hide-menu">AUTH</span>
                      </li>

                  </ul>
              </nav>
              <!-- End Sidebar navigation -->
          </div>
          <!-- End Sidebar scroll-->
      </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                       aria-labelledby="drop2">
                      <div class="message-body">
                          <a onclick="logout()" class="btn btn-outline-primary mx-3 mt-2 d-block">
                              Logout</a>
                          <script>
                              window.onload = function() {
                                  window.logout = function() {
                                      fetch('logout.php', {
                                          method: 'POST',
                                          headers: {
                                              'Content-Type': 'application/json',
                                          },
                                      }).then(response => {
                                          if (response.status) {
                                              window.location.href = '../../../login.php';
                                          }
                                      });
                                  }
                              }
                          </script>
                      </div>
                  </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Enviar un mensaje</h5>



        <!-- Formulario para enviar un mensaje -->
        <form id="crearMensajeForm" action="gestionMensajes.php" method="post">
            <div class="container-fluid py-5 mt-5">
                <div class="container py-5">
                    <div class="row g-4 mb-5">
                        <div class="col-lg-8 col-xl-9">
                            <div id="prod_edit" class="row g-4">
                                <?php
                                require 'conexion.php';
                                // Fetch user details from 'usuario', 'cliente', and 'datospago' tables
                                $id = $_SESSION['id'];
                                // Display inputs for editing
                                $stmt = $conexion->prepare("SELECT usuario.*,cliente.Nombre AS cliente FROM usuario INNER JOIN cliente ON cliente.id_usuario=usuario.id WHERE usuario.id != ?");
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                echo '
                            <div class="col-lg-6">
                                <div class="border rounded p-4">
                                    <h2>Usuario</h2>
                                    <input type="text" id="filter" placeholder="Filtrar resultados">
                                    <select name="receptor" id="receptor">';
                                echo '<option value="0" >Todos los clientes</option>';
                                echo '<option value="Jefe" >Jefe</option>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['cliente'].'#'. $row['id'] . '</option>';
                                }
                                echo '</select>';
                                echo '</div>
                                <div class="border rounded p-4 mt-4">
                                    <h2>Mensaje</h2>
                                    <textarea class="form-control" name="mensaje" id="mensaje" rows="5" required></textarea>
                                </div
                            </div>';

                                $conexion->close();
                                ?>
                                <!-- Submit Button -->
                                <button type="submit" id="editar" class="btn btn-warning rounded-pill px-4 py-2 mt-4"><i class="fa fa-edit me-2"></i> Mandar mensaje</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        $host = "complist.mysql.database.azure.com";
$user = "complist";
$db_password = "ISI2023-2024";
$db = "sabercomer";
$conexion = new mysqli($host, $user, $db_password, $db);

$id_usuario = $_SESSION['id']; // Asegúrate de tener la sesión iniciada y el ID del usuario disponible

// Consulta para obtener los mensajes del usuario
$sql_mensajes = "SELECT mensajes.*,adiministrador.Nombre AS admin ,duenio.Nombre AS duenio 
                 FROM mensajes 
                 LEFT JOIN adiministrador ON adiministrador.id_usuario=mensajes.id_remitente 
                 LEFT JOIN duenio ON duenio.id_usuario=mensajes.id_remitente 
                 WHERE id_receptor = ? ";
$stmt_mensajes = $conexion->prepare($sql_mensajes);
$stmt_mensajes->bind_param("i", $id_usuario);
$stmt_mensajes->execute();
$result_mensajes = $stmt_mensajes->get_result();

while ($mensajes = $result_mensajes->fetch_assoc()) {
    echo '<tr>';
    if($mensajes['admin']){
        echo '<td>' . $mensajes['admin'] . '</td>';
    }
    else if($mensajes['duenio']){
        echo '<td>' . $mensajes['duenio'] . '</td>';
    }
    echo '<td>' . $mensajes['fecha'] . '</td>
          <td>' . $mensajes['mensaje'] . '</td>';

    // Agregar remitente
    if($mensajes['admin']){
        echo '<td>Administrador</td>';
    }
    else if($mensajes['duenio']){
        echo '<td>Duenio</td>';
    }

    echo '</tr>';
}
$stmt_mensajes->close();
$conexion->close();

        ?>
    </div>
  </div>
</div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script>
      document.getElementById('filter').addEventListener('input', function(e) {
          console.log("dadadas");
          var filter = e.target.value.toUpperCase();
          var options = document.getElementById('receptor').options;

          for (var i = 0; i < options.length; i++) {
              var optionText = options[i].text.toUpperCase();
              if (optionText.indexOf(filter) > -1) {
                  options[i].style.display = "";
              } else {
                  options[i].style.display = "none";
              }
          }
      });
  </script>
</body>

</html>