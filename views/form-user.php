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
                    <h4 class="card-title text-center">Registro de Usuarios</h4>
                    <br>
                    <form action="" method="POST">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Usuario</label>
                                    <input type="text" id="usuario" name="usuario" class="form-control " required>

                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Correo</label>
                                    <input type="email" id="correo" name="correo" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Telefono</label><br>
                                    <input type="tel" name="telefono" id="telefono" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password">Password</label><br>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="password">Confirmar Password</label><br>
                            <input type="password" name="password2" id="password2" class="form-control" required>


                        </div>




                        <br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><a href="usuarios.php">Cancelar</a></button>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>


    <script type="text/javascript">
        $('#register').click(function(e) {
            e.preventDefault();
            var valid = this.form.checkValidity();

            if (valid) {
                var datos = new FormData();
                datos.append('usuario', $('#usuario').val())
                datos.append('correo', $('#correo').val())
                datos.append('telefono', $('#telefono').val())
                datos.append('password', $('#password').val())
                datos.append('password2', $('#password2').val())


                fetch('../includes/sesion/insertUser.php', {
                    method: 'POST',
                    body: datos,
                }).then((response) => response.json()).then((response => {
                    confirmation(response);
                }))

            }
        });

        function confirmation(r) {
            if (r === 'success') {
                Swal.fire({
                    'title': '¡Mensaje!',
                    'text': 'Usuario Registrado',
                    'icon': 'success',
                    'showConfirmButton': 'false',
                    'color': '#000000',

                    'timer': '1500'
                }).then(function() {
                    window.location = "usuarios.php";
                });
            }
            if (r === 'error') {
                Swal.fire({
                    'title': 'Error',
                    'text': 'No se creo el usuario',
                    'color': '#000000',
                    'icon': 'error'
                })
            }
            if (r === 'mail') {
                Swal.fire({
                    'title': 'Alerta',
                    'text': 'Este usuario ya esta registrado prueba con otro o inicia sesión',
                    'color': '#000000',
                    'icon': 'info'
                })
            }
            if (r === 'pass') {
                Swal.fire({
                    'title': 'Alerta',
                    'text': 'Las contraseñas no coinciden',
                    'color': '#000000',
                    'icon': 'info'
                })
            }


        }
    </script>