



$(document).ready(function()
{

    $( "#precio" ).focus();


    $( "#precio" ).keyup(function() {
        set_values_by_precio_lista();
    });


    $( "#gope" ).mousedown(function() {
        set_values_by_precio_lista();

    });


    $( "#cont_real" ).keyup(function() {
        set_values_by_cont_real();
    });

    $("#cont_real").bind('keyup mouseup', function () {
        set_values_by_cont_real();
    });






});


function set_values_by_precio_lista()
{

    var precio  = $('#precio').val();


    if($("#gope").is(':checked'))
        var gope = 0;
    else
        var gope = 1;

    var precio_venta = calcular_contado( precio, gope );
    var precio_real  = precio_venta;
    var ganancia     = calcular_ganancia ( precio, gope )

    var mp_sugerido  = precio_venta * 1.059;
    var ml_sugerido  = precio_venta * 1.11;

    $('#cont_sugerido').val(precio_venta);
    $('#cont_real').val(precio_real);
    $('#cont_ganancia').val(ganancia);

    $('#mp_sugerido').val(mp_sugerido);
    $('#ml_sugerido').val(ml_sugerido);
}

function set_values_by_cont_real()
{

    var precio      = $('#precio').val();
    var precio_real = $('#cont_real').val();


    if($("#gope").is(':checked'))
        var gope = 1;
    else
        var gope = 0;

    var precio_venta = calcular_contado( precio, gope );

    var ganancia        = calcular_ganancia_by_real ( precio, precio_real, gope )

    // $('#cont_sugerido').val(precio_venta);
    // $('#cont_real').val(precio_real);
    $('#cont_ganancia').val(ganancia);

}




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
        var indice_aumento = 1.36;


     else if ( precio > 2000 && precio < 2501 )
        var indice_aumento = 1.35;


     else if ( precio > 2500 && precio < 3001 )
        var indice_aumento = 1.34;


     else if ( precio > 3000 && precio < 20000 )
        var indice_aumento = 1.33;
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


function calcular_ganancia_by_real( precio_lista, precio_real, es_gope )
{


    console.log('me pasaste como precio real::::::::' + precio_real);

    var ind_aumento = calcular_ind_aumento( precio_lista );

    if ( es_gope == 1 ) {
        // GOPE descuento un 20%
        var precio_compra = precio_lista * 0.8;
        console.log('es gope me queda el precio en: ' + precio_compra );

    } else {
        var precio_compra = precio_lista * 0.85;
        console.log('NO es gope me queda el precio en: ' + precio_compra );

    }

    var ganancia        = precio_real - precio_compra;

    console.log( ' devuelvo la ganancia que voy a retornar: ' + ganancia );

    return ganancia;

}





