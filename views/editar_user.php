<?php include "../includes/header.php"; ?>
<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
require_once("../includes/db.php");
$consulta = "SELECT * FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_assoc($resultado);

////////////////// VARIABLES DE CONSULTA////////////////////////////////////
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Editar Registro de <?php echo $row['usuario']; ?> </h4>
                    <br>
                    <form id="editarUser<?php echo $row['id']; ?>" method="POST">

                        <div class="form-group">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" id="usuario" name="usuario" class="form-control " value="<?php echo $row['usuario']; ?>" required>
                        </div>


                        <div class="form-group">

                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $row['correo']; ?>" required>
                        </div>


                        <div class="form-group">
                            <label for="telefono">Telefono</label><br>
                            <input type="tel" name="telefono" id="telefono" class="form-control" value="<?php echo $row['telefono']; ?>" required>
                        </div>



                        <br>
                        <input type="hidden" name="accion" value="editar_user">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="register" onclick="editarUser(<?php echo $row['id']; ?>)" name="registrar">Guardar</button>
                            <a href="usuarios.php" class="btn btn-danger" data-dismiss="modal">Cancelar</a>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
    <script>
        function editarUser(id) {
            var datosFormulario = $("#editarUser" + id).serialize();

            $.ajax({
                url: "../includes/functions.php",
                type: "POST",
                data: datosFormulario,
                dataType: "json",
                success: function(response) {
                    if (response === "correcto") {
                        alert("El registro se ha actualizado correctamente");
                        setTimeout(function() {
                            location.assign('usuarios.php');
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