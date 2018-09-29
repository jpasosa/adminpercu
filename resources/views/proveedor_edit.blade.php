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
                    <strong>LISTA DE PRODUCTOS DE PEDIDO A PROVEEDORES NRO: {{ $provider->number }}</strong> |
                    <a href="http://clientes.percu.com.ar/cotizacion/{{ $provider->number }}" target="_blank">
                        <button type="button" class="btn btn-info">LINK</button>
                    </a>
                    ||

                    <a href="{{ url('proveedores') }}">
                        <button type="button" class="btn btn-info">Volver al Listado</button>
                    </a>


                </h3>
            </div>
            <div class="box-header">
                <h3 class="box-title"></h3>
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
                                            Precio Lista (unidad)
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Subtotal
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Descuento
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Total
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subt_price = 0;
                                        $discount_price = 0;
                                        $total_price = 0;
                                    @endphp
                                    @forelse ( $providers_products as $prov)
                                        @php
                                            $subt_price += $prov->subt_price;
                                            $discount_price += $prov->discount_price;
                                            $total_price += $prov->total_price;
                                        @endphp
                                        <tr role="row" class="odd" id="id_prod_provider_{{ $prov->id }}">
                                            <td>{{ $prov->quantity }}</td>
                                            <td>{{ $prov->product->manufacturer }}</td>
                                            <td>{{ $prov->product->code }}</td>
                                            <td>{{ $prov->product->name }}</td>
                                            <td>${{ $prov->list_price }}</td>
                                            <td>${{ $prov->subt_price }}</td>
                                            <td>${{ $prov->discount_price }}</td>
                                            <td>${{ $prov->total_price }}</td>
                                            <td>
                                                <a href="#" id="id_prod_provider_{{ $prov->id }}" class="erase_product_provider" data-id_product_provider="{{ $prov->id }}" style="color: #e86f6f;">
                                                    <i class="fa fa-fw fa-eraser"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr role="row" class="odd">
                                            No existen registros . . . .
                                        </tr>
                                    @endforelse
                                    @if( count($providers_products) != 0 )
                                        <tr role="row" class="odd" >
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>TOTALES</strong></td>
                                            <td><strong>${{ $subt_price }}</strong></td>
                                            <td><strong>${{ $discount_price }}</strong></td>
                                            <td><strong>${{ $total_price }}</strong></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-7">
                            {{ $product->render() }}
                        </div>
                   </div> --}}
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
                <form method="POST" action="{{ url("proveedor/editar/agregar_producto") }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="admin_provider_id" value="{{ $provider->id }}" >
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
                                <input type="text" class="form-control" id="" name="aclarations" placeholder="" value="{{ old('aclarations') }}" >
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info" value="Guardar Producto">
                {!! Form::close() !!}
            </div>
        </div>
    </div>



    <div class="row">
        <form method="POST" action="{{ url("proveedor/editar/agregar_data") }}">
            {{ csrf_field() }}
            <input type="hidden" name="admin_provider_id" value="{{ $provider->id }}">
            <h4><strong>DATOS</strong></h4>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"><strong>ESTADO</strong></label>
                    <select class="form-control" name="status">
                        @foreach( $status AS $k => $estado )
                            @if ( $estado == $provider->status)
                                <option value="{{ $k }}" selected="selected">{{ $estado }}</option>
                            @else
                                <option value="{{ $k }}" >{{ $estado }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Fecha Abonado</label>
                    @if ($provider->date_aboned != null)
                        <input type="text" class="form-control" data-provide="datepicker" name="date_aboned" placeholder="" value="{{ old('date_aboned', $provider->date_aboned->format('m/d/Y')) }}" >
                    @else
                        <input type="text" class="form-control" data-provide="datepicker" name="date_aboned" placeholder="" value="{{ old('date_aboned', '') }}" >
                    @endif
                </div>
                @if( $errors->has('date_aboned') )
                    <p><code>{{ $errors->first('date_aboned') }}</code></p>
                @endif
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Fecha Llegada</label>
                    @if ($provider->date_arrived != null)
                        <input type="text" class="form-control" data-provide="datepicker" name="date_arrived" placeholder="" value="{{ old('date_arrived', $provider->date_arrived->format('m/d/Y')) }}" >
                    @else
                        <input type="text" class="form-control" data-provide="datepicker" name="date_arrived" placeholder="" value="{{ old('date_arrived', '') }}" >
                    @endif
                </div>
                @if( $errors->has('date_arrived') )
                    <p><code>{{ $errors->first('date_arrived') }}</code></p>
                @endif
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Importe abonado</label>
                    <input type="text" class="form-control" name="price_fixed" placeholder="" value="{{ old('price_fixed', $provider->price_fixed) }}" >
                </div>
                @if( $errors->has('price_fixed') )
                    <p><code>{{ $errors->first('price_fixed') }}</code></p>
                @endif
            </div>

            <h4><strong>Notas</strong></h4>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"></label>
                    <textarea type="text" class="form-control" rows="5" name="description">{{ old('description', $provider->description) }}</textarea>
                </div>
            </div>

            <div class="col-sm-8">
               <input type="submit" class="btn btn-info" value="Guardar Datos"><br><br>
            </div>
        {!! Form::close() !!}

    </div>


    <div class="row"></div>










</div>
@endsection




<script type="text/javascript">







</script>










