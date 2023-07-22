<?php include "../includes/header.php"; ?>
<style>
    /* Add the following styles to set the text color to white while typing */
    input:focus {
        color: white;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Registro de Clientes</h4>
                    <br>
                    <form id="clienteForm">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control " required>

                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Apellido</label>
                                    <input type="text" id="apellido" name="apellido" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Domicilio</label><br>
                                    <input type="text" name="domicilio" id="domicilio" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Fecha</label><br>
                                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Monto</label><br>
                                    <input type="number" name="monto" id="monto" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Servicio</label><br>
                                    <select name="id_servicio" id="id_servicio" class="form-control" required>
                                        <option value="">Selecciona una opcion</option>
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
                        <input type="hidden" name="accion" value="insertar_cliente">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                            <a href="clientes.php" class="btn btn-danger" data-dismiss="modal">Cancelar</a>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>

    <script>
        $(document).ready(function() {
            $('#clienteForm').submit(function(e) {
                e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
                var formData = $(this).serialize(); // Serializa los datos del formulario
                $.ajax({
                    url: '../includes/functions.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json', // Espera una respuesta en formato JSON
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Los datos se guardaron correctamente'
                            }).then(function() {
                                window.location = "clientes.php"; // Redirecciona al usuario a la página deseada
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error inesperado'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error inesperado'
                        });
                    }
                });
            });
        });
    </script>