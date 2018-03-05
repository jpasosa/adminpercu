$(document).ready(function()
{



    var id_province = 1;
    $.get('/ajax-get_state?id_province=' + id_province, function( data )
    {
        $('#state').empty();
        $.each( data, function( index, objState){
            $('#state').append('<option value="' + objState.id + '">' + objState.name + '</option>');
        });

    });



    $('#province').on('change', function(e)
    {

        var id_province = e.target.value;

        $.get('/ajax-get_state?id_province=' + id_province, function( data )
        {
            $('#state').empty();
            $.each( data, function( index, objState){
                $('#state').append('<option value="' + objState.id + '">' + objState.name + '</option>');
            });

        });




    })

});