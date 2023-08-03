$(document).ready(function () {
    var originalRows = $('table tbody').html();


    function updateTable(data) {
        $('table tbody').empty();

        $.each(data, function (index, item) {
            $('table tbody').append(`
                <tr style="color: white;">
                    <td data-idClient="${item.id_client}" data-idServ=${item.id_servicio}>${item.folio}</td>
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
            console.log(request)
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
$("#pagoImp").click(function (e) { 
    e.preventDefault();
    var data = new FormData
    var idServ = $("#searchResults>tbody>tr:first>td:first").data("idserv")
    var idClient = $("#searchResults>tbody>tr:first>td:first").data("idclient")
    var pago = parseFloat($("#searchResults>tbody>tr:first>td:nth-child(5)").text().substring(1)).toFixed(2)
    
    if(idServ != undefined || idClient != undefined){
    data.append('accion', 'saveReport')
    data.append('id_serv', idServ)
    data.append('id_cli', idClient)
    data.append('pago', pago)

    fetch('../includes/functions.php',{
        method: 'POST',
        body: data
    }).then(response => response.json())
    .then(function (response) {
     if(response.status == 'success'){
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=800,height=600,left=-1000,top=-1000`;
        open(`../includes/ticket.php?id=${response.reportId}`, 'ticket', params);
        Swal.fire({
            icon: 'success',
            title: 'Servicio pagado',
            text: 'Servicio marcado como pagado',
          })
          $('#searchInput').val("");
          $('table tbody').html(originalRows);
     }
     if(response.status == 'error'){
        Swal.fire({
            icon: 'error',
            title: 'No se pudo acceder a la base de datos',
            text: 'contacte al administrador',
          })
     }
    })
}
else{
    Swal.fire({
        icon: 'error',
        title: 'Datos incorrectos',
        text: 'Revisa los datos de servicio',
      })
}
});
});