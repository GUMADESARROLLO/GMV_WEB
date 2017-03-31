<script>
$(document).ready(function() {
        //$("#modalEdit").openModal();
        //editGrupo("4","sac4");
		$('#tblCobros').DataTable({
            "scrollCollapse": true,
            "info":    false,            
            "lengthMenu": [[20,30,50,100,-1], [20,30,50,100,"Todo"]],
            "language": {
                "zeroRecords": "NO HAY RESULTADOS",
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior"                    
                },
                "lengthMenu": "MOSTRAR _MENU_",
                "emptyTable": "NO HAY DATOS DISPONIBLES",
                "search":     "BUSCAR"
            }
        });
        $('#tbl1 tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });
        $('#tbl2 tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });
});
    
    $("#guardarGrupo").click(function(){
        if ($('#grupo').val()=="" || $('#grupo').val().length<5) {
            mensaje("DIGITE UN NOMBRE VALIDO","error");$('#grupo').focus();return false;
        }if ($("#ListUser").val()==null) {
            mensaje("SELECCIONE UN RESPONSABLE DE GRUPO","error");$('#ListUser').focus();return false;
        }else{
            $('#loadDetalle').show();
            document.getElementById("formNuevoGrupo").submit();
        }
    });
    function editGrupo (id,nombre) {
        $("#modalEdit").openModal();
        $("#titul").html("GRUPO: "+nombre);
        $("#loadTabla").show();
        $("#loadTabla1").show();
        $("#tbl2").hide();
        $("#tbl1").hide();        
        
        $('#tbl1').DataTable({
            ajax: "getVendedoresGrupoAct/"+ id,
            "destroy": true,
            "info":    false,
            "bPaginate": false,
            "paging": false,
            "ordering": false,
            "pagingType": "full_numbers",
            "emptyTable": "No hay datos disponibles en la tabla",
                columns: [
                    { "data": "IDUSUARIO" },
                    { "data": "RUTA" },
                    { "data": "NOMBRE" }
                ]
        });
        $('#tbl2').DataTable({
            ajax: "getVendedoresGrupo/"+ id,
            "destroy": true,
            "info":    false,
            "bPaginate": false,
            "paging": false,
            "ordering": false,
            "pagingType": "full_numbers",
            "emptyTable": "No hay datos disponibles en la tabla",
            columns: [
                    { "data": "IDUSUARIO" },
                    { "data": "IDVENDEDOR" },
                    { "data": "NOMBRE" }
                ]
        });
        $("#loadTabla").hide();
        $("#tbl2").show();
        $("#loadTabla1").hide();
        $("#tbl1").show();
    }
    $('#addRight').click( function (){
        var table = $('#tbl1').DataTable();
        var table2 = $('#tbl2').DataTable();
        var data = table.rows('.selected').data();
        for (var i=0; i < data.length ;i++){
            //alert("IDUSUARIO: " + data[i]['IDUSUARIO'] + " RUTA: " + data[i]['RUTA'] + " NOMBRE: " + data[i]['NOMBRE']);
            table2.row.add( {
                "IDUSUARIO":      data[i]['IDUSUARIO'],
                "IDVENDEDOR":   data[i]['RUTA'],
                "NOMBRE":       data[i]['NOMBRE']
            } ).draw();
        }
        var rows = table.rows( '.selected' ).remove().draw();
    });
    $('#addLeft').click( function (){
        var table = $('#tbl2').DataTable();
        var table2 = $('#tbl1').DataTable();
        var data = table.rows('.selected').data();
        for (var i=0; i < data.length ;i++){
            //alert("IDUSUARIO: " + data[i]['IDUSUARIO'] + " RUTA: " + data[i]['RUTA'] + " NOMBRE: " + data[i]['NOMBRE']);
            table2.row.add( {
                "IDUSUARIO":      data[i]['IDUSUARIO'],
                "RUTA":     data[i]['IDVENDEDOR'],
                "NOMBRE":       data[i]['NOMBRE']
            } ).draw();           
        }
        var rows = table.rows( '.selected' ).remove().draw();
    });
    $("#guardarEdicion").click(function(){
        tabla = $('#tbl2').DataTable();
        var linea = 0;
        tabla.rows().data().each( function (index,value) {
            alert(tabla.row(linea).data().NOMBRE)
            linea++;
        });
        //alert("guardando...");
    })
</script>