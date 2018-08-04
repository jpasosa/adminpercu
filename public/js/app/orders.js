$(document).ready(function()
{
    // Selección de Marca / Producto
    $('.erase_product_order').on('click', function(e)
    {
        var id_order_product = $(this).data("id_product_order");
        var selector_tr = '#prod_order_' + id_order_product;
        $.get('/ajax-erase_order_product?id_order_product=' + id_order_product, function( data )
        {
            if (data) {
                $(selector_tr).animate({'line-height':0},1000).hide(1);
            } else {
                console.log('no se pudo eliminar');
            }
        });
    });

});