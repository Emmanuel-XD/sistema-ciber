<style>
    .modal-content {
        background-color: #fff;
        color: #000;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        /* Sombreado sutil */
    }

    .modal-header .close {
        font-size: 1.5rem;
        font-weight: bold;
        opacity: 0.7;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .modal-footer .btn-secondary {
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ccc;
    }

    .modal-footer .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
    }

    .modal-footer .btn-secondary:hover,
    .modal-footer .btn-primary:hover {
        opacity: 0.8;
    }
</style>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas Seguro de Cerrar Sesion?</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal">
                    <i class="mdi mdi-close" aria-hidden="true"></i></button>
                </button>
            </div>
            <div class="modal-body">Selecciona "Logout" para cerrar sesion.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="../includes/sesion/cerrarSesion.php">Logout</a>
            </div>
        </div>
    </div>
</div>