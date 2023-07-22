<?php include "../includes/header.php"; ?>
<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
require_once("../includes/db.php");
$consulta = "SELECT c.id, c.folio, c.nombre, c.apellido, c.domicilio, c.fecha,
c.monto,c.id_servicio, s.servicio  FROM clientes c INNER JOIN servicios s ON c.id_servicio = s.id WHERE c.id = $id";
$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_assoc($resultado);

////////////////// VARIABLES DE CONSULTA////////////////////////////////////
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Editar Registro de <?php echo $row['nombre']; ?> </h4>
                    <br>
                    <form id="editarCli<?php echo $row['id']; ?>" method="POST">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control " value="<?php echo $row['nombre']; ?>" required>

                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Apellido</label>
                                    <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo $row['apellido']; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Domicilio</label><br>
                                    <input type="text" name="domicilio" id="domicilio" class="form-control" value="<?php echo $row['domicilio']; ?>" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Fecha</label><br>
                                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $row['fecha']; ?>" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Monto</label><br>
                                    <input type="number" name="monto" id="monto" class="form-control" value="<?php echo $row['monto']; ?>" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Servicio</label><br>
                                    <select name="id_servicio" id="id_servicio" class="form-control" required>
                                        <option <?php echo $row['id_servicio'] === 'id_servicio' ? 'selected' : ''; ?> value="<?php echo $row['id_servicio']; ?>"><?php echo $row['servicio']; ?></option>
                                        <?php

                                        include("../includes/db.php");
                                        //Codigo para mostrar categorias desde otra tabla
                                        $sql = "SELECT * FROM servicios ";
                                        $resultado = mysqli_query($conexion, $sql);
                                        while ($consulta = mysqli_fetch_array($resultado)) {
                                            echo '<option value="' . $consulta['id'] . '">' . $consulta['servicio'] . '</option>';
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>




                        <br>
                        <input type="hidden" name="accion" value="editar_cliente">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="register" onclick="editarCli(<?php echo $row['id']; ?>)" name="registrar">Guardar</button>
                            <a href="clientes.php" class="btn btn-danger" data-dismiss="modal">Cancelar</a>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
    <script>
        function editarCli(id) {
            var datosFormulario = $("#editarCli" + id).serialize();

            $.ajax({
                url: "../includes/functions.php",
                type: "POST",
                data: datosFormulario,
                dataType: "json",
                success: function(response) {
                    if (response === "correcto") {
                        alert("El registro se ha actualizado correctamente");
                        setTimeout(function() {
                            location.assign('clientes.php');
                        }, 2000);
                    } else {
                        alert("Ha ocurrido un error al actualizar el registro");
                    }
                },
                error: function() {
                    alert("Error de comunicacion con el servidor");
                }
            });
        }
    </script>