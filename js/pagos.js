$(document).ready(function () {
    var originalRows = $('table tbody').html();

    function updateTable(data) {
        $('table tbody').empty();

        $.each(data, function (index, item) {
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
        source: function (request, response) {
            $.ajax({
                type: 'GET',
                url: 'search.php',
                data: {
                    term: request.term
                },
                dataType: 'json',
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item.folio + ' - ' + item.nombre,
                            value: item.nombre
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            $('#searchInput').val(ui.item.value);
            $.ajax({
                type: 'GET',
                url: 'search.php',
                data: {
                    term: ui.item.value
                },
                dataType: 'json',
                success: function (data) {
                    updateTable(data);
                }
            });
            return false;
        },
        close: function (event, ui) {
            var searchTerm = $('#searchInput').val().trim();
            if (searchTerm === '') {
                $('table tbody').html(originalRows);
            }
        }
    });

    // Agregar un control adicional para verificar si el campo de búsqueda está vacío y restaurar la tabla original
    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val().trim();
        if (searchTerm === '') {
            $('table tbody').html(originalRows);
        }
    });
});