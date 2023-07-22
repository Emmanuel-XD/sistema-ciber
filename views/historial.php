<?php include "../includes/header.php"; ?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Historial De Pagos</h4>
                    <div>
                        <a href="pagos.php" class="btn btn-success">
                            Realizar un nuevo pago <i class="mdi mdi-plus-box"></i> </a>


                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>IdPago</th>
                                    <th> Folio </th>
                                    <th> Nombre </th>
                                    <th> Fecha </th>
                                    <th> Pago </th>
                                    <th> Servicio </th>
                                    <th> Imprimir </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                require_once("../includes/db.php");
                                $result = mysqli_query($conexion, "SELECT h.id, h.id_cliente, h.id_servicio, h.pago, h.fecha, c.folio, c.nombre, s.servicio FROM historial h 
                                INNER JOIN clientes c ON h.id_cliente = c.id INNER JOIN servicios s ON h.id_servicio = s.id");
                                while ($fila = mysqli_fetch_assoc($result)) :

                                ?>
                                    <tr style="color: white;">
                                        <td><?php echo $fila['id']; ?></td>
                                        <td><?php echo $fila['folio']; ?></td>
                                        <td><?php echo $fila['nombre']; ?></td>
                                        <td><?php echo $fila['fecha']; ?></td>
                                        <td><?php echo '$' . $fila['pago']; ?></td>
                                        <td><?php echo $fila['servicio']; ?></td>

                                        <td>

                                            <a href="../includes/imprimirTicketp?id=<?php echo $fila['id'] ?> " class="btn btn-secondary">
                                                <i class="mdi mdi-cloud-print-outline"></i></a></button>
                                        </td>
                                    </tr>


                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include "../includes/footer.php"; ?>