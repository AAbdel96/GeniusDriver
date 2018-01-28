$(document).ready(function () {
    var table = $('#cars').DataTable();
    var $matricula;
    $('#cars tbody').on('click', 'tr', function () {



        if ($(this).hasClass('selected')) {

            $(this).removeClass('selected');


        } else {
            table.$('tr.selected').removeClass('selected');
            $matricula = $(this).closest("tr").find("td:eq(2)").text();
            $(this).addClass('selected');
            


        }
    });

    $('#button_cars').click(function () {

        alert("Seguro que desea eliminar el coche con matricula:" + $matricula);
        table.row('.selected').remove().draw(true);
        
        $.ajax({
            url: 'http://localhost/SampleWS/eliminar_coche.php',           
            type: 'POST',
           
            data: {matricula: $matricula},

            success: function (data, textStatus, jQxhr) {
                $('#response pre').html(data);
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });

        saveData.error(function () {
            alert("Something went wrong");
        });

    });
});



