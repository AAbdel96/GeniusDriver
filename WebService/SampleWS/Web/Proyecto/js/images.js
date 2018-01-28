$(document).ready(function () {
    var table = $('#images').DataTable();
    var $id;
    $('#images tbody').on('click', 'tr', function () {



        if ($(this).hasClass('selected')) {

            $(this).removeClass('selected');


        } else {
            table.$('tr.selected').removeClass('selected');
            $id = $(this).closest("tr").find("td:eq(0)").text();
            $(this).addClass('selected');
            


        }
    });

    $('#eliminar_imagen').click(function () {

        alert("Seguro que desea eliminar a " + $email);
        table.row('.selected').remove().draw(true);
        
        $.ajax({
            url: 'http://localhost/SampleWS/eliminar_imagen.php',           
            type: 'POST',
            
            data: {id: $id},

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



