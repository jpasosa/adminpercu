@extends('adminlte::page')

@section('htmlheader_title')
    Nuevo Cliente
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        @if( $errors->any() )
                                <div class="alert alert-danger">
                                    <h5><strong>Error!</strong> Por favor corregir los errores marcados debajo. . .</h5>
                                </div>
                            @endif
                        <form method="POST" action="{{ url("clientes/nuevo") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <span class="label label-success">Agregar Nuevo Cliente</span>



                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre</label>
                                        <input type="text" class="form-control" id="" name="name" placeholder="Indique el nombre de la comparsa" value="{{ old('name') }}"   >
                                    </div>
                                    @if( $errors->has('name') )
                                        <p><code>{{ $errors->first('name') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Apellido</label>
                                        <input type="text" class="form-control" id="" name="last_name" placeholder="Indique el nombre de la bateria" value="{{ old('last_name') }}"   >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Usuario de MercadoLibre</label>
                                        <input type="text" class="form-control" id="" name="user_ml" placeholder="Indique el nombre de la bateria" value="{{ old('user_ml') }}"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Email</label>
                                        <input type="email" class="form-control" id="" name="email" placeholder="Indique el nombre de la bateria" value="{{ old('email') }}"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">DNI</label>
                                        <input type="number" class="form-control" id="" name="dni" placeholder="Indique el nombre de la bateria" value="{{ old('dni') }}"  >
                                    </div>
                                    @if( $errors->has('dni') )
                                        <p><code>{{ $errors->first('dni') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Teléfono</label>
                                        <input type="number" class="form-control" id="" name="phone" placeholder="Indique el nombre de la bateria" value="{{ old('phone') }}"  >
                                    </div>
                                    @if( $errors->has('phone') )
                                        <p><code>{{ $errors->first('phone') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Por donde Nos Conociste ?</label>
                                        <select class="form-control" id="marketing" name="marketing">
                                                @foreach ($marketing as $id=>$market)
                                                    @if (old('marketing') == $id)
                                                          <option value="{{ $id }}" selected>{{ $market }}</option>
                                                    @else
                                                          <option value="{{ $id }}">{{ $market }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Facebook</label>
                                        <input type="text" class="form-control" id="" name="face" placeholder="4000" value="{{ old('face') }}" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Amigos ? </label>
                                        <div class="form-group">
                                            <select class="form-control" id="sel1" name="friends">
                                                    @if (old('friends') == '1')
                                                          <option value="1" selected>SI</option>
                                                          <option value="0" >NO</option>
                                                    @else
                                                          <option value="1">SI</option>
                                                          <option value="0" selected>NO</option>
                                                    @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Provincia de Residencia</label>
                                        <select class="form-control" id="admin_province_residence_id" name="admin_province_residence_id">
                                                 @foreach ($admin_province_residence_id as $id=>$name)
                                                    @if (old('admin_province_residence_id') == $id)
                                                          <option value="{{ $id }}" selected>{{ $name }}</option>
                                                    @else
                                                          <option value="{{ $id }}">{{ $name }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                    @if( $errors->any() )
                                        <p><code><strong>Error!</strong>Debe Seleccionar nuevamente la provincia.</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Localidad de Residencia</label>
                                        <select class="form-control" id="admin_state_residence_id" name="admin_state_residence_id">
                                            <option value="">Selecciones antes la provincia, luego la localidad . . .</option>
                                        </select>
                                    </div>
                                    @if( $errors->any() )
                                        <p><code><strong>Error!</strong>Debe Seleccionar nuevamente la localidad.</code></p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Provincia de Envío</label>
                                        <select class="form-control" id="admin_province_shipping_id" name="admin_province_shipping_id">
                                                @foreach ($admin_province_shipping_id as $id=>$name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    @if( $errors->any() )
                                        <p><code><strong>Error!</strong>Debe Seleccionar nuevamente la provincia.</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Localidad de Envío</label>
                                        <select class="form-control" id="admin_state_shipping_id" name="admin_state_shipping_id">
                                            <option value="">Selecciones antes la provincia, luego la localidad . . .</option>
                                        </select>
                                    </div>
                                    @if( $errors->any() )
                                        <p><code><strong>Error!</strong>Debe Seleccionar nuevamente la localidad.</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Comparsa a la que pertenece</label>
                                        <select class="form-control" id="admin_comparsas_id" name="admin_comparsas_id">
                                                <option value="null">No Pertenesco a Ninguna . . . .</option>
                                                @foreach ($admin_comparsas_id as $comp)
                                                    @if (old('admin_comparsas_id') == $comp['id'])
                                                          <option value="{{ $comp['id'] }}" selected>{{ $comp['name_comparsa'] }} | {{  $comp['name_bateria']  }}</option>
                                                    @else
                                                          <option value="{{ $comp['id'] }}">{{ $comp['name_comparsa'] }} | {{  $comp['name_bateria']  }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Observaciones</label>
                                        <textarea type="text" class="form-control" rows="5" name="observations">{{ old('observations') }}</textarea>
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





