$(document).ready(function()
{
    // Eliminar un pedido a proveedores
    $('.erase_comparsa').on('click', function(e)
    {

        var confirma = confirm("Desea eliminar la comparsa ???");
        if (confirma == true)
        {
            var id_comparsa = $(this).data("id_comparsa");
            var selector_tr = '#id_comparsa_' + id_comparsa;
            $.get('/ajax-erase_comparsa?id_comparsa=' + id_comparsa, function( data )
            {
                if (data != 'false') {
                    $(selector_tr).animate({'line-height':0},1000).hide(1);
                } else {
                    console.log('La comparsa pertenece a un cliente, no se puede eliminar . . .');
                }
            });

        } else {
            // no hace nada.
        }




    });

});