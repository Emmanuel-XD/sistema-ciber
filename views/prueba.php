<script>
    $("#start").change(function() {

        var endDate = new Date($("#start").val());
        //default config reporte mensual
        var month = endDate.getMonth() + 2;
        var year = endDate.getFullYear();
        var day = endDate.getDate() + 1;
        //si el reporte es semanal
        if ($("#type").val() == 2) {
            var month = endDate.getMonth() + 1;
            var day = endDate.getDate() + 8;
        }
        //si el reporte es diario
        if ($("#type").val() == 3) {
            var month = endDate.getMonth() + 1;
              var year = endDate.getFullYear();
              var day = endDate.getDate() + 1;
        }
        if (day < 10) {
            day = '0' + day;
        }
        if (month < 10) {
            month = '0' + month;
        }

        end = year + '-' + month + '-' + day
        console.log(year + '-' + month + '-' + day)
        $("#fin").val(end);
    })
</script>