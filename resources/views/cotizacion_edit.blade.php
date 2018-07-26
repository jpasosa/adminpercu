@extends('adminlte::page')

@section('htmlheader_title')
    Edición de la Cotización
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <strong>LISTA DE PRODUCTOS DE LA COTIZACION NRO: {{ $quotation->number }}</strong> |
                    <a href="http://clientes.percu.com.ar/cotizacion/{{ $quotation->number }}" target="_blank">
                        <button type="button" class="btn btn-info">LINK</button>
                    </a>
                    ||

                    <a href="{{ url('cotizaciones') }}">
                        <button type="button" class="btn btn-info">Volver al Listado</button>
                    </a>

                    || <input type="button" class="btn btn-warning" value="Realizar ORDEN">

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
                                    @forelse ( $quotation_products as $quot)
                                        @php
                                            $subtotal = $quot->product->cash_price * $quot->quantity;
                                        @endphp

                                        <tr role="row" class="odd" id="prod_quot_{{ $quot->id }}">
                                            <td>{{ $quot->quantity }}</td>
                                            <td>{{ $quot->product->manufacturer }}</td>
                                            <td>{{ $quot->product->name }}</td>
                                            <td>${{ $quot->product->cash_price }}</td>
                                            <td>${{ $quot->product->mp_price }}</td>
                                            <td>${{ $subtotal }}</td>
                                            <td>
                                                <a href="#" class="erase_product" data-id_quotation="{{ $quot->id }}" >
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
                <form method="POST" action="{{ url("cotizacion/editar/agregar_producto") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <input type="hidden" name="admin_quotation_id" value="{{ $quotation->id }}">
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
                                        <input type="text" class="form-control" id="" name="aclarations" placeholder="" value="{{ old('facebook_page') }}" >
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info" value="Guardar Producto">
                        {!! Form::close() !!}
            </div>
        </div>
    </div>


</div>
@endsection




<script type="text/javascript">







</script>









