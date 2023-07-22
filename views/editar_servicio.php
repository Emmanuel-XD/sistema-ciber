<?php include "../includes/header.php"; ?>
<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
require_once("../includes/db.php");
$consulta = "SELECT * FROM servicios WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_assoc($resultado);

////////////////// VARIABLES DE CONSULTA////////////////////////////////////
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Registro de Servicio </h4>
                    <br>
                    <form id="editServ<?php echo $row['id']; ?>" method="POST">

                        <div class="form-group">
                            <label for="nombre" class="form-label">Descripcion del servicio</label>
                            <input type="text" id="servicio" name="servicio" class="form-control " value="<?php echo $row['servicio']; ?>" required>
                        </div>


                        <br>
                        <input type="hidden" name="accion" value="editar_servicio">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="register" onclick="editarServ(<?php echo $row['id']; ?>)" name="registrar">Guardar</button>
                            <a href="servicios.php" class="btn btn-danger" data-dismiss="modal">Cancelar</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>

    <script>
        function editarServ(id) {
            var datosFormulario = $("#editServ" + id).serialize();

            $.ajax({
                url: "../includes/functions.php",
                type: "POST",
                data: datosFormulario,
                dataType: "json",
                success: function(response) {
                    if (response === "correcto") {
                        alert("El registro se ha actualizado correctamente");
                        setTimeout(function() {
                            location.assign('servicios.php');
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