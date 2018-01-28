$(document).ready(function () {
    var table = $('#example').DataTable();
    var $email;
    $('#example tbody').on('click', 'tr', function () {



        if ($(this).hasClass('selected')) {

            $(this).removeClass('selected');


        } else {
            table.$('tr.selected').removeClass('selected');
            $email = $(this).closest("tr").find("td:eq(1)").text();
            $(this).addClass('selected');
            


        }
    });

    $('#button').click(function () {

        alert("Seguro que desea eliminar a " + $email);
        table.row('.selected').remove().draw(true);
        
        $.ajax({
            url: 'http://localhost/SampleWS/eliminar_usuario.php',           
            type: 'POST',
           
            data: {email: $email},

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



