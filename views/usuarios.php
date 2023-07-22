<?php include "../includes/header.php"; ?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lista de usuarios</h4>
                    <div>
                        <button type="button" class="btn btn-success"><a href="form-user.php">
                                Agregar usuario <i class="mdi mdi-account-multiple-plus"></i> </a>
                        </button>

                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th> Usuario </th>
                                    <th> Correo </th>
                                    <th> Telefono </th>
                                    <th> Fecha </th>
                                    <th> Acciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                require_once("../includes/db.php");
                                $result = mysqli_query($conexion, "SELECT * FROM usuarios");
                                while ($fila = mysqli_fetch_assoc($result)) :

                                ?>
                                    <tr style="color: white;">
                                        <td><?php echo $fila['usuario']; ?></td>
                                        <td><?php echo $fila['correo']; ?></td>
                                        <td><?php echo $fila['telefono']; ?></td>
                                        <td><?php echo $fila['fecha']; ?></td>


                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id']; ?>">
                                                <i class="mdi mdi-lead-pencil"></i>
                                            </button>

                                            <a href="../includes/eliminar_user.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
                                                <i class="mdi mdi-delete"></i></a></button>
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

    <script>
        $('.btn-del').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'Estas seguro de eliminar este registro?',
                text: "¡No podrás revertir esto!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Eliminado!',
                            'El registro fue eliminado.',
                            'success'
                        )
                    }

                    document.location.href = href;
                }
            })

        })
    </script>