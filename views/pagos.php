<?php include "../includes/header.php"; ?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Relizar Pago de Servicio de Internet</h4>
                    <br>
                    <div>
                        <label for="" class="form-laberl">Buscador <i class="mdi mdi-yeast"></i> </label>

                        <input type="text" class="form-control" placeholder="Escribe el numero de folio o nombre del cliente...">

                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="">
                            <thead>
                                <tr>
                                    <th> Folio </th>
                                    <th> Nombre </th>
                                    <th> Apellido </th>
                                    <th> Domicilio </th>
                                    <th> Pago </th>
                                    <th> Servicio </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                require_once("../includes/db.php");
                                $result = mysqli_query($conexion, "SELECT c.id, c.folio, c.nombre, c.apellido, c.domicilio, c.fecha,
c.monto,c.id_servicio, s.servicio  FROM clientes c INNER JOIN servicios s ON c.id_servicio = s.id");
                                while ($fila = mysqli_fetch_assoc($result)) :

                                ?>
                                    <tr style="color: white;">
                                        <td><?php echo $fila['folio']; ?></td>
                                        <td><?php echo $fila['nombre']; ?></td>
                                        <td><?php echo $fila['apellido']; ?></td>
                                        <td><?php echo $fila['domicilio']; ?></td>
                                        <td><?php echo '$' . $fila['monto']; ?></td>
                                        <td><?php echo $fila['servicio']; ?></td>

                                    </tr>


                                <?php endwhile; ?>
                            </tbody>

                        </table>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"> PAGAR IMPORTE <i class="mdi mdi-square-inc-cash"></i> </button>
                </div>

            </div>
        </div>

    </div>

    <?php include "../includes/footer.php"; ?>