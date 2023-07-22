<?php include "../includes/header.php"; ?>

<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">


<div class="main-panel">
    <div class="content-wrapper">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Realizar Pago de Servicio de Internet</h4>
                    <br>
                    <div>
                        <label for="" class="form-laberl">Buscador <i class="mdi mdi-yeast"></i> </label>

                        <input type="text" class="form-control" id="searchInput" placeholder="Escribe el número de folio o nombre del cliente...">

                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="searchResults">
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
    <!-- Por alguna razon los script tienen que esta debajo del footer o del vendor.bundle.base.js no se que pex -->
    <script src="../js/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            var originalRows = $('table tbody').html();

            function updateTable(data) {
                $('table tbody').empty();

                $.each(data, function(index, item) {
                    $('table tbody').append(`
                        <tr style="color: white;">
                            <td>${item.folio}</td>
                            <td>${item.nombre}</td>
                            <td>${item.apellido}</td>
                            <td>${item.domicilio}</td>
                            <td>${item.monto}</td>
                            <td>${item.servicio}</td>
                        </tr>
                    `);
                });
            }

            $('#searchInput').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: 'GET',
                        url: 'search.php',
                        data: {
                            term: request.term
                        },
                        dataType: 'json',
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.folio + ' - ' + item.nombre,
                                    value: item.nombre
                                };
                            }));
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    $('#searchInput').val(ui.item.value);
                    $.ajax({
                        type: 'GET',
                        url: 'search.php',
                        data: {
                            term: ui.item.value
                        },
                        dataType: 'json',
                        success: function(data) {
                            updateTable(data);
                        }
                    });
                    return false;
                },
                close: function(event, ui) {
                    var searchTerm = $('#searchInput').val().trim();
                    if (searchTerm === '') {
                        $('table tbody').html(originalRows);
                    }
                }
            });

            // Agregar un control adicional para verificar si el campo de búsqueda está vacío y restaurar la tabla original
            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val().trim();
                if (searchTerm === '') {
                    $('table tbody').html(originalRows);
                }
            });
        });
    </script>

    </html>