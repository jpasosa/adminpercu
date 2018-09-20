<html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!--[if IE]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <![endif]-->
        <title>ORDEN :: percu.com.ar</title>

        {{ Html::style('frontend/css/bootstrap.css') }}
        {{ Html::style('frontend/css/style.css') }}
        <!--ver -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container outer-section">
            <div id="print-area">
                <h3>
                    <span class="alert-success"><strong>ORDEN: </strong>#{{ $order->number }}</span>
                </h3>
                <div class="row pad-top font-big">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <img src="http://percu.com.ar/image/cache/catalog/logo1-350x109.jpg" alt="Percu" />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <strong>Website : </strong><a href="http://percu.com.ar/" target="_blank">http://percu.com.ar/</a>
                        <br />
                        <strong>Consultas:</strong>
                        <a href="mailto:info@percu.com.ar">
                            info@percu.com.ar
                        </a>
                        <br />
                        <strong>Facebook :</strong><a href="https://www.facebook.com/comparsas.percu/" target="_blank">/comparsas.percu/</a><br />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4" style="font-size: 28px;font-weight: bold; color: #fff;">
                        @if ( $order->quickStatus == 'PAGADO' )
                            <span class="alert-success">ESTADO: PAGADA</span>
                        @elseif ( $order->quickStatus == 'RESERVADO' )
                            <span class="alert-info">ESTADO: RESERVADA</span>
                        @else ( $order->quickStatus == 'NO PAGADO' )
                            <span class="alert-warning">ESTADO: NO PAGADA</span>
                        @endif
                    </div>
                </div>
                <br />
                <hr />



                <div class="row text-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        Mirá nuestro stock para envío inmediato!
                        <a target="_blank" href="{{ url('clientes/productos/en-stock') }}" class="btn btn-success">
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
                        <h4><strong>ORDEN: </strong>#{{ $order->number }}</h4>
                        <h4>
                            <strong>
                                @if ( $order->date_cash != null )
                                    {{ Carbon\Carbon::parse($order->date_cash)->toFormattedDateString() }}
                                @elseif ( $order->date_mp != null )
                                    {{ Carbon\Carbon::parse($order->date_mp)->toFormattedDateString() }}
                                @else ( $order->date_ml != null )
                                    {{ Carbon\Carbon::parse($order->date_ml)->toFormattedDateString() }}
                                @endif
                            </strong>
                        </h4>
                        <h4><strong>Método de pago: </strong>{{ $order->paymentMethod }}</h4>
                        @if($order->paymentMethod == 'MERCADOPAGO')
                            <h4><strong>ID mercadopago: </strong>{{ $order->idcobro_mp }}</h4>
                        @elseif($order->paymentMethod == 'MERCADOLIBRE')
                            <h4><strong>ID mercadolibre: </strong>{{ $order->idcobro_ml }}</h4>
                        @endif
                    </div>
                </div>
                <hr />
                @if( $order->empresa_send != '')
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h4>Empresa de Envío: <strong>{{  $order->empresa_send }}</strong></h4>
                            <h4>Fecha: <strong>{{  Carbon\Carbon::parse($order->date_send)->toFormattedDateString() }}</strong></h4>
                            <h4>Código de Seguimiento: <strong>{{  $order->codetrack_send }}</strong></h4>
                            <h4>Importe al Retirar: <strong>${{  $order->cash_send }}</strong></h4>
                        </div>
                    </div>
                @endif
                <br />
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr bgcolor="#FFEB00">
                                        <th style="color: #018000">Cantidad</th>
                                        <th style="color: #018000">Marca</th>
                                        <th style="color: #018000">Codigo</th>
                                        <th style="color: #018000">Producto</th>
                                        <th colspan="2" style="color: #018000">
                                            {{ $order->paymentMethod }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td bgcolor="#C5C5C5"></td>
                                        <td bgcolor="#C5C5C5"></td>
                                        <td bgcolor="#C5C5C5"></td>
                                        <td bgcolor="#C5C5C5"></td>
                                        <td bgcolor="#E3E3E3"><strong>Por Unidad</strong></td>
                                        <td bgcolor="#E3E3E3"><strong>Subtotal</strong></td>
                                    </tr>
                                    @php
                                        $subtotal   = 0;
                                        $total     = 0;
                                    @endphp

                                    @forelse ( $orders_products as $prod)
                                        @php
                                            if($order->paymentMethod == 'EFECTIVO'):
                                                $price      = $prod->product->cash_price;
                                                $subtotal   = $price * $prod->quantity;
                                            elseif($order->paymentMethod == 'MERCADOPAGO'):
                                                $price      = $prod->product->mp_price;
                                                $subtotal   = $price * $prod->quantity;
                                            elseif($order->paymentMethod == 'MERCADOLIBRE'):
                                                $price      = $prod->product->ml_price;
                                                $subtotal   = $price * $prod->quantity;
                                            else:
                                                $price      = $prod->product->cash_price;
                                                $subtotal   = $price * $prod->quantity;
                                            endif;
                                            $total     += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $prod->quantity }}</td>
                                            <td>{{ $prod->product->manufacturer }}</td>
                                            <td>{{ $prod->product->code }}</td>
                                            <td>{{ $prod->product->name }}</td>
                                            <td>${{ $price }}</td>
                                            <td>${{ $subtotal }}</td>
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
                                        <td><strong>${{ $total }}</strong></td>
                                    </tr>
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
                                        <td>&nbsp;</td>
                                        <td>Debe Abonar: </td>
                                        <td>
                                            <strong>
                                                $
                                                @if($order->paymentMethod == 'EFECTIVO')
                                                    {{ $order->total_cash_fixed }}
                                                @elseif($order->paymentMethod == 'MERCADOPAGO')
                                                    {{ $order->total_mp_fixed }}
                                                @elseif($order->paymentMethod == 'MERCADOLIBRE')
                                                    {{ $order->total_ml_fixed }}
                                                @else
                                                    {{ $order->total_cash_fixed }}
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
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
                                        <td>&nbsp;</td>
                                        <td>Abonado: </td>
                                        <td>
                                            <strong>
                                                $
                                                @if($order->paymentMethod == 'EFECTIVO')
                                                    {{ $order->abonado_cash }}
                                                @elseif($order->paymentMethod == 'MERCADOPAGO')
                                                    {{ $order->abonado_mp }}
                                                @elseif($order->paymentMethod == 'MERCADOLIBRE')
                                                    {{ $order->abonado_ml }}
                                                @else
                                                    {{ $order->abonado_cash }}
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Observaciones</label>
                                <textarea class="form-control" rows="5"  readonly="readonly">{{ $order->observations }}</textarea>
                            </div>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </body>

</html>
