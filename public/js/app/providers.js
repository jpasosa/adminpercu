$(document).ready(function()
{
    // Eliminar un pedido a proveedores
    $('.erase_provider').on('click', function(e)
    {
        var id_provider = $(this).data("id_provider");
        var selector_tr = '#id_provider_' + id_provider;
        $.get('/ajax-erase_provider?id_provider=' + id_provider, function( data )
        {
            if (data) {
                $(selector_tr).animate({'line-height':0},1000).hide(1);
            } else {
                console.log('no se pudo eliminar');
            }
        });
    });

    // Eliminar un producto en los proveedores
    $('.erase_product_provider').on('click', function(e)
    {
        var id_product_provider = $(this).data("id_product_provider");
        var selector_tr = '#id_prod_provider_' + id_product_provider;
        $.get('/ajax-erase_provider_product?id_product_provider=' + id_product_provider, function( data )
        {
            if (data) {
                $(selector_tr).animate({'line-height':0},1000).hide(1);
            } else {
                console.log('no se pudo eliminar');
            }
        });
    });



});