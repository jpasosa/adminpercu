$(document).ready(function()
{
    // Eliminar un producto de stock
    $('.erase_stock_product').on('click', function(e)
    {
        var id_product_stock = $(this).data("id_product");
        var selector_tr = '#prod_stock_' + id_product_stock;
        $.get('/ajax-erase_stock_product?id_product_stock=' + id_product_stock, function( data )
        {
            if (data) {
                $(selector_tr).animate({'line-height':0},1000).hide(1);
            } else {
                console.log('no se pudo eliminar');
            }
        });
    });

    // Agregar un producto de stock
    $('.add_stock_product').on('click', function(e)
    {
        var id_product_stock = $(this).data("id_product");
        var selector_tr = '#prod_order_' + id_product_stock;
        $.get('/ajax-add_stock_product?id_product_stock=' + id_product_stock, function( data )
        {
            if (data) {
                console.log('Agregó uno, recargue la página . . .');
            } else {
                console.log('Error! NO pudo Agregar . . .');
            }
        });
    });

    // Bajar cantidad de stock de un producto
    $('.down_stock_product').on('click', function(e)
    {
        var id_product_stock = $(this).data("id_product");
        var selector_tr = '#prod_order_' + id_product_stock;
        $.get('/ajax-down_stock_product?id_product_stock=' + id_product_stock, function( data )
        {
            if (data) {
                console.log('Sacó uno, recargue la página . . .');
            } else {
                console.log('Error! NO pudo Agregar . . .');
            }
        });
    });



});