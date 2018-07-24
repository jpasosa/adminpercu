@extends('adminlte::page')

@section('htmlheader_title')
    Nueva Cotización
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        @if( $errors->any() )
                                <div class="alert alert-danger">
                                    <h5>
                                        <strong>Error!</strong>
                                        Por favor corregir los errores marcados debajo. . .
                                    </h5>

                                </div>
                            @endif
                        <form method="POST" action="{{ url("cotizaciones/nueva") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <span class="label label-success">Agregar Nueva Cotizacion</span>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Cliente</label>
                                        <select class="form-control" id="admin_client_id" name="admin_client_id">
                                                <option value="">Seleccione cliente . . . .</option>
                                                @foreach ($admin_clients as $client)
                                                    @if (old('admin_clients') == $client['id'])
                                                          <option value="{{ $client['id'] }}" selected>{{ $client['name'] }} </option>
                                                    @else
                                                          <option value="{{ $client['id'] }}">{{ $client['name'] }} </option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        @if( $errors->has('admin_client_id') )
                                            <p><code>{{ $errors->first('admin_client_id') }}</code></p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Precio Fijado Efectivo</label>
                                        <input type="number" class="form-control" id="" name="price_cash_fixed" placeholder="0" value="{{ old('price_cash_fixed') }}" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Precio Fijado TC</label>
                                        <input type="number" class="form-control" id="" name="price_mp_fixed" placeholder="0" value="{{ old('price_mp_fixed') }}" >
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Observaciones</label>
                                        <textarea type="text" class="form-control" rows="5" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <input type="submit" class="btn btn-info" value="Guardar">



                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




<script type="text/javascript">







</script>





