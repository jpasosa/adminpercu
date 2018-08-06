$(document).ready(function()
{
    // Selección de Marca / Producto
    $('.erase_product').on('click', function(e)
    {
        var id_quotation_product = $(this).data("id_quotation");
        var selector_tr = '#prod_quot_' + id_quotation_product;
        $.get('/ajax-erase_quotation_product?id_quotation_product=' + id_quotation_product, function( data )
        {
            if (data) {
                $(selector_tr).animate({'line-height':0},1000).hide(1);
            } else {
                console.log('no se pudo eliminar');
            }
        });
    });




    // Pasar la cotización a Orden
    $('#pass_to_order').on('click', function(e)
    {
        var id_quotation = $(this).data("idquotation");
        console.log(id_quotation);

        var selector_tr = '#prod_order_' + id_quotation;
        $.get('/ajax-quotation_to_order/' + id_quotation, function( data )
        {
            if (data) {
                var link = '/orden/editar/' + data;
                var button_order = '<a href="' + link +'"><button type="button" class="btn btn-info">Ver Orden Generada</button></a>';
                $('#linkorder').append(button_order);
            } else {
                console.log('Hubo un error');
            }
        });


    });





});