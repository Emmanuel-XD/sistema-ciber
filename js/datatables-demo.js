$(document).ready(function () {
  $('#dataTable').DataTable({
    order: [
      [1, 'desc']
    ],
    language: {
      processing: "Tratamiento en curso...",
      search: "Buscar:",
      lengthMenu: "Filtro de _MENU_ registros",
      info: "Mostrando del registro _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "No existen registros",
      infoFiltered: "(filtro de _MAX_ registos en total)",
      infoPostFix: "",
      loadingRecords: "Cargando elementos...",
      zeroRecords: "No se encontraron los datos de tu busqueda..",
      emptyTable: "No hay ningun registro en la tabla",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Ultimo"
      },
      aria: {
        sortAscending: ": Active para odernar en modo ascendente",
        sortDescending: ": Active para ordenar en modo descendente  ",
      }
    }
  });
});