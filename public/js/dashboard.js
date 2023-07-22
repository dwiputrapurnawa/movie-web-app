$(function() {
    feather.replace();

    $(".table").DataTable();

    $('.table').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );

    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true 
    });


    $("#img").on("change", function() {

        var file = $(this).get(0).files[0];

        if(file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#preview-img").attr("src", reader.result);
            }

            reader.readAsDataURL(file)
        }

    });
});

