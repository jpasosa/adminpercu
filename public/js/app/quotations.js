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

});