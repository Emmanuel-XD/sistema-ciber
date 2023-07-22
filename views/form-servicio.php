<?php include "../includes/header.php"; ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Registro de Servicio </h4>
                    <br>
                    <form id="servicioForm">

                        <div class="form-group">
                            <label for="nombre" class="form-label">Descripcion del servicio</label>
                            <input type="text" id="servicio" name="servicio" class="form-control " required>
                        </div>


                        <br>
                        <input type="hidden" name="accion" value="insertar_servicio">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                            <a href="servicios.php" class="btn btn-danger" data-dismiss="modal">Cancelar</a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
    <script>
        $(document).ready(function() {
            $('#servicioForm').submit(function(e) {
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
                                window.location = "servicios.php"; // Redirecciona al usuario a la página deseada
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