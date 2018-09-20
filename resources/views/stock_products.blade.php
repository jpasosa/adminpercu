@extends('adminlte::page')

@section('htmlheader_title')
    Stock
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <strong>PRODUCTOS EN STOCK</strong>
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
                                            Observaciones
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $stock_products as $stock_prod)
                                        <tr role="row" class="odd" id="prod_stock_{{ $stock_prod->id }}">
                                            <td>{{ $stock_prod->quantity }}</td>
                                            <td>{{ $stock_prod->product->manufacturer }}</td>
                                            <td>{{ $stock_prod->product->code }}</td>
                                            <td>{{ $stock_prod->product->name }}</td>
                                            <td>{{ $stock_prod->observations }}</td>
                                            <td>
                                                <a href="#" class="erase_stock_product" data-id_product="{{ $stock_prod->id }}" style="color: #e86f6f;">
                                                    <i class="fa fa-fw fa-eraser"></i>
                                                </a>
                                                <a href="#" class="add_stock_product" data-id_product="{{ $stock_prod->id }}" >
                                                    <i class="fa fa-fw fa-arrow-circle-up"></i>
                                                </a>
                                                <a href="#" class="down_stock_product" data-id_product="{{ $stock_prod->id }}" >
                                                    <i class="fa fa-fw fa-arrow-circle-down"></i>
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
                <form method="POST" action="{{ url("stock/agregar") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
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
                                        <label for="exampleFormControlInput1">Observaciones (elimina la anterior, copiar si hace falta)</label>
                                        <input type="text" class="form-control" id="" name="observations" placeholder="" value="{{ old('observations') }}" >
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










