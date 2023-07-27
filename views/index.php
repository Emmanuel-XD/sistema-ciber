<?php include "../includes/header.php"; ?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <a href="../views/clientes.php" class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">Numero de clientes: <?php
                                                                            require_once("../includes/db.php");

                                                                            $SQL = "SELECT id FROM clientes ORDER BY id";
                                                                            $dato = mysqli_query($conexion, $SQL);
                                                                            $fila = mysqli_num_rows($dato);

                                                                            echo ($fila); ?></h3>

                                </a>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <i class="mdi mdi-account-check"></i>

                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Clientes</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <a href="../views/servicios.php" class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">Numero de servicios: <?php
                                                                            require_once("../includes/db.php");

                                                                            $SQL = "SELECT id FROM servicios ORDER BY id";
                                                                            $dato = mysqli_query($conexion, $SQL);
                                                                            $fila = mysqli_num_rows($dato);

                                                                            echo ($fila); ?></h3>

                                </a>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <i class=" mdi mdi-book-minus"></i>


                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Servicios</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <a href="../views/historial.php" class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0"><?php
                                                        require_once("../includes/db.php");
                                                        date_default_timezone_set('America/Mexico_City');
                                                        // Obtener la fecha actual
                                                        $today = date("Y-m-d");

                                                        // Consulta SQL para obtener la suma total de los pagos del día actual
                                                        $SQL = "SELECT SUM(pago) as pago FROM historial WHERE fecha = '2023-07-22'";
                                                        $resultado = mysqli_query($conexion, $SQL);
                                                        $fila = mysqli_fetch_assoc($resultado);

                                                        // Mostrar el total de pagos del día
                                                        $totalPagosDia = $fila['pago'];
                                                        echo "Total de pagos: $" . $totalPagosDia;
                                                        ?>
                                    </h3>

                                </a>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <i class="mdi mdi-laptop-chromebook"></i>

                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Pagos</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <a href="../views/usuarios.php" class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">Numero de usuarios: <?php
                                                                            require_once("../includes/db.php");

                                                                            $SQL = "SELECT id FROM usuarios ORDER BY id";
                                                                            $dato = mysqli_query($conexion, $SQL);
                                                                            $fila = mysqli_num_rows($dato);

                                                                            echo ($fila); ?></h3>

                                </a>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">

                                    <i class=" mdi mdi-account-multiple"></i>

                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Usuarios</h6>
                    </div>
                </div>
            </div>
        </div>




    </div>


    <!-- container-scroller -->

    <?php include "../includes/footer.php"; ?>