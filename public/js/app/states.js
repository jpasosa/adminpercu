$(document).ready(function()
{


    var old_state_residence = $('#old_admin_state_residence_id').val();
    console.log( 'old_province' + old_state_residence );

    // var id_province = 1;
    // $.get('/ajax-get_state?id_province=' + id_province, function( data )
    // {
    //     $('#admin_state_residence_id').empty();
    //     $.each( data, function( index, objState){
    //         $('#admin_state_residence_id').append('<option value="' + objState.id + '">' + objState.name + '</option>');
    //     });
    //     $('#admin_state_shipping_id').empty();
    //     $.each( data, function( index, objState){
    //         $('#admin_state_shipping_id').append('<option value="' + objState.id + '">' + objState.name + '</option>');
    //     });
    //     $('#state').empty();
    //     $.each( data, function( index, objState){
    //         $('#state').append('<option value="' + objState.id + '">' + objState.name + '</option>');
    //     });

    // });


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