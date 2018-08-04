@extends('adminlte::page')

@section('add_in_head')

<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

@endsection

@section('htmlheader_title')
    Edición de la Cotización
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <strong>ORDEN NRO: {{ $order->number }}</strong> |
                    <a href="http://clientes.percu.com.ar/orden/{{ $order->number }}" target="_blank">
                        <button type="button" class="btn btn-info">LINK</button>
                    </a>
                    ||

                    <a href="{{ url('ordenes') }}">
                        <button type="button" class="btn btn-info">Volver al Listado de Ordenes</button>
                    </a>

                    || <input type="button" class="btn btn-warning" value="Realizar ORDEN">

                </h3>
                        <form method="POST" action="{{ url("orden/editar/cambiar_estado") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <input type="hidden" name="admin_order_id" value="{{ $order->id }}">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1"><strong>ESTADO DE LA ORDEN</strong></label>
                                        <select class="form-control" name="status">
                                            @foreach( $status AS $k => $estado )
                                                @if ( $estado == $order->status)
                                                    <option value="{{ $k }}" selected="selected">{{ $estado }}</option>
                                                @else
                                                    <option value="{{ $k }}" >{{ $estado }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info" value="Modificar Estado">
                        {!! Form::close() !!}

            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            @if ( Session::has('success_message'))
                                <div class="box-body">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Perfecto!</strong> {{ Session::get('success_message') }}
                                    </div>
                                </div>
                            @endif

                            @if ( Session::has('error_message'))
                                <div class="box-body">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Error!</strong> {{ Session::get('error_message') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><strong>LISTA DE PRODUCTOS</strong></h3>
                            </div>

                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                Cantidad
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Marca
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Codigo
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Producto
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                Efectivo (unidad)
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                TC / Otros Medios (unidad)
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                Efectivo (sub-total)
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $orders_products as $order_prod)
                                            @php
                                                $subtotal = $order_prod->product->cash_price * $order_prod->quantity;
                                            @endphp

                                            <tr role="row" class="odd" id="prod_order_{{ $order_prod->id }}">
                                                <td>{{ $order_prod->quantity }}</td>
                                                <td>{{ $order_prod->product->manufacturer }}</td>
                                                <td>{{ $order_prod->product->code }}</td>
                                                <td>{{ $order_prod->product->name }}</td>
                                                <td>${{ $order_prod->product->cash_price }}</td>
                                                <td>${{ $order_prod->product->mp_price }}</td>
                                                <td>${{ $subtotal }}</td>
                                                <td>
                                                    <a href="#" class="erase_product_order" data-id_product_order="{{ $order_prod->id }}" >
                                                        <i class="fa fa-fw fa-eraser"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr role="row" class="odd">
                                                No existen registros . . . .
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Agregar Producto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="{{ url("orden/editar/agregar_producto") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <input type="hidden" name="admin_order_id" value="{{ $order->id }}">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Cantidad</label>
                                        <input type="text" class="form-control" name="quantity" placeholder="1" value="{{ old('quantity', 1) }}" >
                                    </div>
                                    @if( $errors->has('quantity') )
                                            <p><code>{{ $errors->first('quantity') }}</code></p>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Marca</label>
                                        <select class="form-control" id="manufacturer" name="manufacturer_id">
                                                @foreach ($manufacturers AS $id => $manufact)
                                                    @if (old('manufacturer_id') == $id)
                                                          <option value="{{ $id }}" selected="selected">{{ $manufact }}</option>
                                                    @else
                                                          <option value="{{ $id }}">{{ $manufact }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        @if( $errors->has('manufacturer_id') )
                                            <p><code>{{ $errors->first('manufacturer_id') }}</code></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Instrumento</label>
                                        <select class="form-control" id="products" name="product_id">
                                            <option value="">Seleccione antes la marca . . .</option>
                                        </select>
                                        @if( $errors->has('product_id') )
                                            <p><code>{{ $errors->first('product_id') }}</code></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Aclaraciones</label>
                                        <input type="text" class="form-control" id="" name="clarifications" placeholder="" value="{{ old('facebook_page') }}" >
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info" value="Guardar Producto">
                        {!! Form::close() !!}
            </div>
        </div>
    </div>

    <form method="POST" action="{{ url("orden/editar/agregar_datos") }}">
        {{ csrf_field() }}
        <input type="hidden" name="admin_order_id" value="{{ $order->id }}">
        <div class="row">
            <h4><strong>DATOS DE PAGOS</strong></h4>
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">

                            </th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                Efectivo / Transferencia
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                Mercadopago
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                Mercadolibre
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="odd" id="prod_quot_{{ $order->id }}">
                            <td>
                                <div class="form-group">
                                    Total Calculado Automatico
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" readonly="readonly" name="" placeholder="1" value="{{ $order->totalCash }}" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" readonly="readonly" name="" placeholder="0" value="{{ $order->totalMp }}" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" readonly="readonly" name="" placeholder="0" value="{{ $order->totalMl }}" >
                                </div>
                            </td>
                        </tr>
                        <tr role="row" class="odd" id="prod_quot_{{ $order->id }}">
                            <td>
                                <div class="form-group">
                                    Total Real
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="total_cash_fixed" placeholder="0" value="{{ old('total_cash_fixed', $order->total_cash_fixed) }}" >
                                </div>
                                @if( $errors->has('total_cash_fixed') )
                                    <p><code>{{ $errors->first('total_cash_fixed') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="total_mp_fixed" placeholder="0" value="{{ old('total_mp_fixed', $order->total_mp_fixed) }}" >
                                </div>
                                @if( $errors->has('total_mp_fixed') )
                                    <p><code>{{ $errors->first('total_mp_fixed') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="total_ml_fixed" placeholder="0" value="{{ old('total_ml_fixed', $order->total_ml_fixed) }}" >
                                </div>
                                @if( $errors->has('total_ml_fixed') )
                                    <p><code>{{ $errors->first('total_ml_fixed') }}</code></p>
                                @endif
                            </td>
                        </tr>
                        <tr role="row" class="odd" id="prod_quot_{{ $order->id }}">
                            <td>
                                <div class="form-group">
                                    Total Abonado al momento
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="abonado_cash" placeholder="0" value="{{ old('abonado_cash', $order->abonado_cash) }}" >
                                </div>
                                @if( $errors->has('abonado_cash') )
                                    <p><code>{{ $errors->first('abonado_cash') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="abonado_mp" placeholder="0" value="{{ old('abonado_mp', $order->abonado_mp) }}" >
                                </div>
                                @if( $errors->has('abonado_mp') )
                                    <p><code>{{ $errors->first('abonado_mp') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="abonado_ml" placeholder="0" value="{{ old('abonado_ml', $order->abonado_ml) }}" >
                                </div>
                                @if( $errors->has('abonado_ml') )
                                    <p><code>{{ $errors->first('abonado_ml') }}</code></p>
                                @endif
                            </td>
                        </tr>
                        <tr role="row" class="odd" id="prod_quot_{{ $order->id }}">
                            <td>
                                <div class="form-group">
                                    Fecha Abonado
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    @if ($order->date_cash != null)
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_cash" placeholder="" value="{{ old('date_cash', $order->date_cash->format('m/d/Y') ) }}" >
                                    @else
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_cash" placeholder="" value="{{ old('date_cash', '') }}" >
                                    @endif
                                </div>
                                @if( $errors->has('date_cash') )
                                    <p><code>{{ $errors->first('date_cash') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    @if ($order->date_mp != null)
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_mp" placeholder="" value="{{ old('date_mp', $order->date_mp->format('m/d/Y')) }}" >
                                    @else
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_mp" placeholder="" value="{{ old('date_mp', '') }}" >
                                    @endif
                                </div>
                                @if( $errors->has('date_mp') )
                                    <p><code>{{ $errors->first('date_mp') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    @if ($order->date_ml != null)
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_ml" placeholder="" value="{{ old('date_ml', $order->date_ml->format('m/d/Y')) }}" >
                                    @else
                                        <input type="text" class="form-control" data-provide="datepicker" name="date_ml" placeholder="" value="{{ old('date_ml', '') }}" >
                                    @endif
                                </div>
                                @if( $errors->has('date_ml') )
                                    <p><code>{{ $errors->first('date_ml') }}</code></p>
                                @endif
                            </td>
                        </tr>
                        <tr role="row" class="odd" id="prod_quot_{{ $order->id }}">
                            <td>
                                <div class="form-group">
                                    ID transacciones
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="idcobro_mp" placeholder="" value="{{ old('idcobro_mp', $order->idcobro_mp) }}" >
                                </div>
                                @if( $errors->has('idcobro_mp') )
                                    <p><code>{{ $errors->first('idcobro_mp') }}</code></p>
                                @endif
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="idcobro_ml" placeholder="" value="{{ old('idcobro_ml', $order->idcobro_ml) }}" >
                                </div>
                                @if( $errors->has('idcobro_ml') )
                                    <p><code>{{ $errors->first('idcobro_ml') }}</code></p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> {{-- cierra ROW de datos de pago --}}

        <div class="row">
            <h4><strong>DATOS DE ENVIO</strong></h4>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Fecha Envío</label>
                    @if ($order->date_send != null)
                        <input type="text" class="form-control" data-provide="datepicker" name="date_send" placeholder="" value="{{ old('date_send', $order->date_send->format('m/d/Y')) }}" >
                    @else
                        <input type="text" class="form-control" data-provide="datepicker" name="date_send" placeholder="" value="{{ old('date_send', '') }}" >
                    @endif
                </div>
                @if( $errors->has('date_send') )
                    <p><code>{{ $errors->first('date_send') }}</code></p>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Empresa</label>
                    <input type="text" class="form-control" id="" name="empresa_send" placeholder="" value="{{ old('empresa_send', $order->empresa_send) }}" >
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Codigo de Seguimiento</label>
                    <input type="text" class="form-control" id="" name="codetrack_send" placeholder="" value="{{ old('codetrack_send', $order->codetrack_send) }}" >
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Pago al Retirar</label>
                    <input type="text" class="form-control" id="" name="cash_send" placeholder="" value="{{ old('cash_send', $order->cash_send) }}" >
                </div>
                @if( $errors->has('cash_send') )
                    <p><code>{{ $errors->first('cash_send') }}</code></p>
                @endif
            </div>


        </div>

        <input type="submit" class="btn btn-info" value="Guardar Datos"><br><br>

    {!! Form::close() !!}



    <div class="row"></div>

    <div class="row">
        <h4><strong>NOTAS PRIVADAS</strong></h4>
        <form method="POST" action="{{ url("orden/editar/agregar_nota") }}">
            {{ csrf_field() }}
            <input type="hidden" name="admin_order_id" value="{{ $order->id }}">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="exampleFormControlInput1"></label>
                    <textarea type="text" class="form-control" rows="5" name="note">{{ old('note') }}</textarea>
                </div>
            </div>
            <div class="col-sm-8">
               <input type="submit" class="btn btn-info" value="Agregar Nota"><br><br>
            </div>
        {!! Form::close() !!}
        <div class="col-sm-8">
            @forelse ( $orders_notes as $note)
                <p>
                    {{ Carbon\Carbon::parse($note->created_at)->toFormattedDateString() }} -> {{ $note->note }}
                </p>
            @empty
                <p>
                    No hay notas . . .
                </p>
            @endforelse
        </div>
    </div>






</div>
@endsection











