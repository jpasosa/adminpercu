



$(document).ready(function()
{


    $( "#precio" ).keyup(function()
    {
        var precio  = $('#precio').val();


        if($("#gope").is(':checked'))
            var gope = 1;
        else
            var gope = 0;


        var precio_venta = calcular_contado( precio, gope );

        var ganancia        = calcular_ganancia ( precio, gope )

        $('#cont_sugerido').val(precio_venta);
        $('#cont_ganancia').val(ganancia);


    });







});



function calcular_ind_aumento ( precio )
{

    if (precio > 0 && precio < 301)
        var indice_aumento = 1.5;

     else if ( precio > 300 && precio < 601 )
        var indice_aumento = 1.45;


     else if ( precio > 600 && precio < 901 )
        var indice_aumento = 1.40;


     else if ( precio > 900 && precio < 1501 )
        var indice_aumento = 1.37;


     else if ( precio > 1500 && precio < 2001 )
        var indice_aumento = 1.34;


     else if ( precio > 2000 && precio < 2501 )
        var indice_aumento = 1.31;


     else if ( precio > 2500 && precio < 3001 )
        var indice_aumento = 1.28;


     else if ( precio > 3000 && precio < 20000 )
        var indice_aumento = 1.25;
     else
        var indice_aumento = 0;

    return indice_aumento;


}

function calcular_contado( precio_lista, es_gope )
{

    var ind_aumento = calcular_ind_aumento( precio_lista );

    if ( es_gope == 1 ) {
        // GOPE descuento un 20%
        var precio_compra = precio_lista * 0.8;

    } else {
        var precio_compra = precio_lista * 0.85;
    }

    var precio_venta    = precio_compra * ind_aumento;

    return precio_venta;


}

function calcular_ganancia( precio_lista, es_gope )
{

    var ind_aumento = calcular_ind_aumento( precio_lista );

    if ( es_gope == 1 ) {
        // GOPE descuento un 20%
        var precio_compra = precio_lista * 0.8;

    } else {
        var precio_compra = precio_lista * 0.85;
    }

    var precio_venta    = precio_compra * ind_aumento;
    var ganancia        = precio_venta - precio_compra;

    return ganancia;


}






