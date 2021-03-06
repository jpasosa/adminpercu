$(document).ready(function()
{


    // En Comparsas
    $('#province').on('click', function(e)
    {
        var id_province = e.target.value;
        $.get('/ajax-get_state?id_province=' + id_province, function( data )
        {
            $('#state').empty();
            $.each( data, function( index, objState){
                $('#state').append('<option value="' + objState.id + '">' + objState.name + '</option>');
            });

        });
    });


    // En Clientes
    $('#admin_province_residence_id').on('click', function(e)
    {
        var id_province = e.target.value;
        $.get('/ajax-get_state?id_province=' + id_province, function( data )
        {
            $('#admin_state_residence_id').empty();
            $.each( data, function( index, objState){
                $('#admin_state_residence_id').append('<option value="' + objState.id + '">' + objState.name + '</option>');
            });

        });
    });

    // En Clientes
    $('#admin_province_shipping_id').on('click', function(e)
    {
        var id_province = e.target.value;
        $.get('/ajax-get_state?id_province=' + id_province, function( data )
        {
            $('#admin_state_shipping_id').empty();
            $.each( data, function( index, objState){
                $('#admin_state_shipping_id').append('<option value="' + objState.id + '">' + objState.name + '</option>');
            });

        });
    });


});