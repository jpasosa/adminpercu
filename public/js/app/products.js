$(document).ready(function()
{


    // Selección de Marca / Producto
    $('#manufacturer').on('click', function(e)
    {
        var id_manufacturer = e.target.value;
        $.get('/ajax-get_product?id_manufacturer=' + id_manufacturer, function( data )
        {
            $('#products').empty();
            $.each( data, function( index, objState){
                $('#products').append('<option value="' + objState.id + '">' + objState.name + '</option>');
            });

        });
    });

});