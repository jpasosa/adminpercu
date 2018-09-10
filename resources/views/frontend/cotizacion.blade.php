<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Cotización Percu</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->

    {{ Html::style('frontend/css/bootstrap.css') }}
    {{ Html::style('frontend/css/style.css') }}
    <!--ver -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="container outer-section">
        <div id="print-area">
            <div class="row pad-top font-big">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <img src="http://percu.com.ar/image/cache/catalog/logo1-350x109.jpg" alt="Percu" />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <strong>Website : </strong><a href="http://percu.com.ar/">http://percu.com.ar/</a>
                    <br />
                    <strong>Celular :</strong>(+54 9) 11 5140 8258<br />
                    <strong>Facebook :</strong><a href="https://www.facebook.com/comparsas.percu/">/comparsas.percu/</a><br />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    Mejores marcas traidas de Brasil. Instrumentos en<strong> Stock permanente</strong>.<br>
                    <strong>Envíos a toda la Argentina!! Paga todo en cuotas!! </strong>/<br />
                </div>
            </div>
            <br />
            <hr />
            <div class="row text-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    Mirá nuestro stock para envío inmediato!
                    <a target="_blank" href="http://www.percu.com.ar" class="btn btn-success">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Stock Disponible
                    </a>
                    &nbsp;&nbsp;&nbsp;Entrá a nuestra tienda!
                    <a target="_blank" href="http://www.percu.com.ar" class="btn btn-success">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Ver Tienda Online
                    </a>
                    &nbsp;&nbsp;&nbsp;Buscanos en Facebook
                    <a target="_blank" href="https://www.facebook.com/comparsas.percu/" class="btn btn-info btn-md">
                      <span class="glyphicon glyphicon-thumbs-up"></span> /comparsas.percu
                    </a>
                </div>
            </div>
            <hr />
            <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h4><strong>{{  $client->name . ' ' . $client->last_name }}</strong></h4>
                    <h4>
                        <b>{{ $client->state_residence->name . ' - ' . $client->state_residence->province->name . ' - ' . $client->state_residence->cp }}</b></h4>
                    </h4>
                    <h4>{{ $client->email }}</h4>
                    <h4>{{ $client->phone }}</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h4><strong>Cotización No: </strong>#{{ $quotation->number }}</h4>
                    <h4>
                        {{ Carbon\Carbon::parse($quotation->created_at)->toFormattedDateString() }}
                    </h4>
                </div>
            </div>
            <hr />
            <br />
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th bgcolor="#018000" style="color: #DAFF69">CANTIDAD</th>
                                    <th bgcolor="#018000" style="color: #DAFF69">MARCA</th>
                                    <th bgcolor="#018000" style="color: #DAFF69">PRODUCTO</th>
                                    <th colspan="2" bgcolor="#018000" style="color: #DAFF69">EFECTIVO</th>
                                    <th colspan="2" bgcolor="#018000" style="color: #DAFF69">TARJETA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td bgcolor="#C5C5C5"></td>
                                    <td bgcolor="#C5C5C5"></td>
                                    <td bgcolor="#C5C5C5"></td>
                                    <td bgcolor="#E3E3E3"><strong>Por Unidad

                                    </strong></td>
                                    <td bgcolor="#E3E3E3"><strong>Subtotal</strong></td>
                                    <td bgcolor="#E3E3E3"><strong>Por Unidad </strong></td>
                                    <td bgcolor="#E3E3E3"><strong>Subtotal</strong></td>
                                </tr>

                                @php
                                    $tot_cash   = 0;
                                    $tot_mp     = 0;
                                @endphp

                                @forelse ( $quotation_products as $prod)
                                    @php
                                        $subt_cash  = $prod->product->cash_price * $prod->quantity;
                                        $subt_mp    = $prod->product->mp_price * $prod->quantity;
                                        $tot_cash   += $subt_cash;
                                        $tot_mp     += $subt_mp;
                                    @endphp
                                    <tr>
                                        <td>{{ $prod->quantity }}</td>
                                        <td>{{ $prod->product->manufacturer }}</td>
                                        <td>{{ $prod->product->name }}</td>
                                        <td>${{ $prod->product->cash_price }}</td>
                                        <td>${{ $subt_cash }}</td>
                                        <td>${{ $prod->product->mp_price }}</td>
                                        <td>${{ $subt_mp }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        No existen registros . . . .
                                    </tr>
                                @endforelse
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td></td>
                                  <td><strong>${{ $tot_cash }}</strong></td>
                                  <td>&nbsp;</td>
                                  <td><strong>${{ $tot_mp }}</strong></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr />


        </div>

    </div>

</body>

</html>
