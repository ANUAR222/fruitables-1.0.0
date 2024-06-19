


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png"/>
    <link rel="stylesheet" href="../assets/css/styles.min.css"/>
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
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                                     class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                 aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-list-check fs-6"></i>
                                        <p class="mb-0 fs-3">My Task</p>
                                    </a>
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
            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-8 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Resumen de Ventas por mes</h5>
                                </div>

                            </div>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Yearly Breakup -->
                            <div class="card overflow-hidden">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-9 fw-semibold">Resumen Anual</h5>
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="fw-semibold mb-3">
                                                <?php
                                                $host = "complist.mysql.database.azure.com";
                                                $user = "complist";
                                                $db_password = "ISI2023-2024";
                                                $db = "sabercomer";
                                                $conexion = new mysqli($host, $user, $db_password, $db);
                                                $sql = "SELECT YEAR(Fecha_pedido) as year, SUM(Precio_total) as total FROM pedidos where YEAR(Fecha_pedido) = YEAR(CURDATE()) GROUP BY YEAR(Fecha_pedido)";
                                                $result = $conexion->query($sql);
                                                if ($result === false) {
                                                    // La consulta SQL falló, maneja el error aquí
                                                    echo json_encode(["status" => "error", "message" => "La consulta SQL falló: " . $conexion->error]);
                                                } else {
                                                    $sales = [];
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo $row['total'] . "$";
                                                    }
                                                }
                                                ?>
                                            </h4>
                                            <div class="d-flex align-items-center mb-3">
                          <span
                                  class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                            <?php
                            $currentYeraTotal = $conexion->query("SELECT SUM(Precio_total) FROM pedidos WHERE YEAR(Fecha_pedido) = YEAR(CURDATE())");
                            $lastYearTotal = $conexion->query("SELECT SUM(Precio_total) FROM pedidos WHERE YEAR(Fecha_pedido) = YEAR(CURDATE()) - 1");
                            $currentYeraTotal = $currentYeraTotal->fetch_assoc();
                            $lastYearTotal = $lastYearTotal->fetch_assoc();
                            //i want to the succes if is positive
                            if ($currentYeraTotal['SUM(Precio_total)'] > $lastYearTotal['SUM(Precio_total)']) {
                                echo "<i class='ti ti-arrow-up-left text-success'></i>";
                            } else {
                                echo "<i class='ti ti-arrow-down-right text-danger'></i>";
                            }
                            ?>
                          </span>
                                                <p class="text-dark me-1 fs-3 mb-0">
                                                    <?php
                                                    if ($lastYearTotal['SUM(Precio_total)'] != 0) {
                                                        $percentage = ($currentYeraTotal['SUM(Precio_total)'] - $lastYearTotal['SUM(Precio_total)']) / $lastYearTotal['SUM(Precio_total)'] * 100;
                                                        echo number_format($percentage, 2) . "%";
                                                    } else {
                                                        echo "Last year's total is zero, percentage increase cannot be calculated.";
                                                    }
                                                    ?>
                                                </p>
                                                <p class="fs-3 mb-0">año pasado</p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-center">
                                                <div id="breakup"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- Monthly Earnings -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row alig n-items-start">
                                        <div class="col-8">
                                            <h5 class="card-title mb-9 fw-semibold"> Usuarios registrados este mes </h5>
                                            <h4 class="fw-semibold mb-3">
                                                <?php
                                                $sql = "SELECT COUNT(*) as total FROM usuario where MONTH(fecha_alta) = MONTH(CURDATE())";
                                                $result = $conexion->query($sql);
                                                if ($result === false) {
                                                    // La consulta SQL falló, maneja el error aquí
                                                    echo json_encode(["status" => "error", "message" => "La consulta SQL falló: " . $conexion->error]);
                                                } else {
                                                    $sales = [];
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo $row['total'];
                                                    }
                                                }
                                                ?>
                                            </h4>
                                            <div class="d-flex align-items-center pb-1">
                          <span
                                  class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                            <?php
                            $currentMonthTotal = $conexion->query("SELECT COUNT(*) FROM usuario WHERE MONTH(fecha_alta) = MONTH(CURDATE())");
                            $lastMonthTotal = $conexion->query("SELECT COUNT(*) FROM usuario WHERE MONTH(fecha_alta) = MONTH(CURDATE()) - 1");
                            $currentMonthTotal = $currentMonthTotal->fetch_assoc();
                            $lastMonthTotal = $lastMonthTotal->fetch_assoc();
                            if ($currentMonthTotal['COUNT(*)'] > $lastMonthTotal['COUNT(*)']) {
                                echo "<i class='ti ti-arrow-up-left text-success'></i>";
                            } else {
                                echo "<i class='ti ti-arrow-down-right text-danger'></i>";
                            }
                            ?>
                          </span>
                                                <p class="text-dark me-1 fs-3 mb-0">
                                                    <?php
                                                    if ($lastMonthTotal['COUNT(*)'] != 0) {
                                                        $percentage = ($currentMonthTotal['COUNT(*)'] - $lastMonthTotal['COUNT(*)']) / $lastMonthTotal['COUNT(*)'] * 100;
                                                        echo number_format($percentage, 2) . "%";
                                                    } else {
                                                        echo "Last month's total is zero, percentage increase cannot be calculated.";
                                                    }
                                                    ?>
                                                </p>
                                                <p class="fs-3 mb-0">last year</p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div
                                                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-currency-dollar fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="earning"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Platos mas vendidos</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Plato</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Precio</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Cantidad vendida</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Ventas</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Stock Restante</h6>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php


                                        // Muestra los platos más vendidos y su stock
                                        $sql = "SELECT comidas_de_pedidos.id_comida, comidas.Nombre, comidas.Precio, SUM(comidas_de_pedidos.cantidad) as cant, SUM(comidas_de_pedidos.cantidad)*comidas.Precio as total, COALESCE(SUM(pedido_stock.cantidad), comidas.stock) as stock
FROM comidas_de_pedidos 
JOIN comidas ON comidas_de_pedidos.id_comida = comidas.id 
LEFT JOIN pedido_stock ON comidas.id = pedido_stock.id_comida
GROUP BY comidas_de_pedidos.id_comida 
ORDER BY total DESC";

                                        $result = $conexion->query($sql);

                                        if ($result === false) {
                                            echo json_encode(["status" => "error", "message" => "La consulta SQL falló: " . $conexion->error]);
                                        } else {
                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td class='border-bottom-0'><h6 class='fw-semibold mb-0'>" . $i . "</h6></td>";
                                                echo "<td class='border-bottom-0'>";
                                                echo "<h6 class='fw-semibold mb-1'>" . $row['Nombre'] . "</h6>";
                                                echo "</td>";
                                                echo "<td class='border-bottom-0'>";
                                                echo "<p class='mb-0 fw-normal'>" . $row['Precio'] . "</p>";
                                                echo "</td>";
                                                echo "<td class='border-bottom-0'>";
                                                echo "<div class='d-flex align-items-center gap-2'>";
                                                echo "<span class='badge bg-primary rounded-3 fw-semibold'>" . $row['cant'] . "</span>";
                                                echo "</div>";
                                                echo "</td>";
                                                echo "<td class='border-bottom-0'>";
                                                echo "<h6 class='fw-semibold mb-0 fs-4'>" . $row['total'] . "</h6>";
                                                echo "</td>";
                                                echo "<td class='border-bottom-0'>";
                                                echo "<p class='mb-0 fw-normal'>" . $row['stock'] . "</p>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/dashboard.js"></script>
</body>

</html>