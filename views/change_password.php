<?php include "../includes/header.php"; ?>
<?php

$id = $_GET['id'];
require_once("../includes/db.php");
$consulta = "SELECT * FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_assoc($resultado);

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Cambiar Password de <?php echo $row['usuario']; ?></h4>
                    <br>
                    <form id="editarPass<?php echo $row['id']; ?>" method="POST">

                        <?php
                        $passrand = rand(1000, 9999);
                        ?>
                        <div class="form-group">
                            <label for="password" style="text-align: justify;">Password: Es necesario generar una nueva contraseña o intruduce esta contraseña aleatoria.</label><br>
                            <input type="text" name="password2" id="password2" readonly class="form-control" value="Defaultpass<?php echo $passrand; ?>">
                        </div>



                        <div class="form-group">
                            <label for="nombre" class="form-label">Nuevo Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>




                        <br>

                        <input type="hidden" name="accion" value="editar_password">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="register" onclick="editarPass(<?php echo $row['id']; ?>)" name="registrar">Guardar</button>
                            <a href="usuarios.php" class="btn btn-danger" data-dismiss="modal">Cancelar</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>

    <script>
        function editarPass(id) {
            var datosFormulario = $("#editarPass" + id).serialize();

            $.ajax({
                url: "../includes/functions.php",
                type: "POST",
                data: datosFormulario,
                dataType: "json",
                success: function(response) {
                    if (response === "correcto") {
                        alert("El password fue cambiado exitosamente.");
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