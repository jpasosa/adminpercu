$(document).ready(function()
{
    // Eliminar un pedido a proveedores
    $('.erase_cliente').on('click', function(e)
    {

        var confirma = confirm("Está seguro que desea eliminar al cliente ?");
        if (confirma == true)
        {
            var id_cliente = $(this).data("id_cliente");
            var selector_tr = '#id_cliente_' + id_cliente;
            $.get('/ajax-erase_cliente?id_cliente=' + id_cliente, function( data )
            {
                if (data != 'false') {
                    $(selector_tr).animate({'line-height':0},1000).hide(1);
                } else {
                    console.log('El cliente está inscripto en algún pedido o cotización, no se puede eliminar . . .');
                }
            });

        } else {
            // no hace nada.
        }




    });

});