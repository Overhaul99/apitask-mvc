(function() {
    
        $('.editbtn').on('click', function() {
            $tr=$(this).closest('tr');
            var datos=$tr.children("td").map(function () {
                return $(this).text();
            });
            $('#update_id').val(datos[0]);
            $('#nombre').val(datos[1]);
            $('#email').val(datos[2]);
            if('#area' == 'GAF') {
                datos = '1';
                $('#area').val(datos[3]);
            }
            $('#rangoId').val(datos[4]);
        });

        $('.deletebtn').on('click', function() {
            $tr=$(this).closest('tr');
            var datos=$tr.children("td").map(function () {
                return $(this).text();
            });
            $('#delete_id').val(datos[0]);
        });

})();