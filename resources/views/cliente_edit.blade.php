@extends('adminlte::page')

@section('htmlheader_title')
    Edición del Cliente
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
                                    <h5>
                                        Y controlar nuevamente Provincia y Localidades. . .
                                    </h5>
                                </div>
                            @endif
                        <form method="POST" action="{{ url("cliente/editar/$cliente->id") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <span class="label label-success">Edición de cliente</span>



                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre</label>
                                        <input type="text" class="form-control" id="" name="name" placeholder="Nombre" value="{{ old('name', $cliente->name) }}"   required="required">
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
                                        <input type="text" class="form-control" id="" name="last_name" placeholder="Apellido" value="{{ old('last_name', $cliente->last_name) }}"   >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Usuario de MercadoLibre</label>
                                        <input type="text" class="form-control" id="" name="user_ml" placeholder="User mercadolibre" value="{{ old('user_ml', $cliente->user_ml) }}"  >
                                    </div>
                                    @if( $errors->has('user_ml') )
                                        <p><code>{{ $errors->first('user_ml') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">WhatsApp Nombre</label>
                                        <input type="text" class="form-control" id="" name="user_whatsapp" placeholder="User mercadolibre" value="{{ old('user_whatsapp', $cliente->user_whatsapp) }}"  >
                                    </div>
                                    @if( $errors->has('user_whatsapp') )
                                        <p><code>{{ $errors->first('user_whatsapp') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Email</label>
                                        <input type="email" class="form-control" id="" name="email" placeholder="email" value="{{ old('email', $cliente->email) }}"  >
                                    </div>
                                    @if( $errors->has('email') )
                                        <p><code>{{ $errors->first('email') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">DNI</label>
                                        <input type="number" class="form-control" id="" name="dni" placeholder="Indique su DNI" value="{{ old('dni', $cliente->dni) }}">
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
                                        <input type="number" class="form-control" id="" name="phone" placeholder="+54 9 11 5655 5566" value="{{ old('phone', $cliente->phone) }}"  >
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
                                                @foreach ($cliente::get_marketings() as $id=>$market)
                                                    @if (old('marketing', $cliente->marketing) == $market)
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
                                        <input type="text" class="form-control" id="" name="face" placeholder="4000" value="{{ old('face', $cliente->face) }}" >
                                    </div>
                                    @if( $errors->has('face') )
                                        <p><code>{{ $errors->first('face') }}</code></p>
                                    @endif
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

                            {{-- UBICACION DE RESIDENCIA --}}
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Provincia de Residencia</label>
                                        <select class="form-control" id="admin_province_residence_id" name="admin_province_residence_id">
                                                @foreach ($cliente->state_residence->province->all() AS $prov)
                                                    @if (old('admin_province_id', $cliente->state_residence->province->id) == $prov->id)
                                                          <option value="{{ $prov->id }}" selected="selected">{{ $prov->name }}</option>
                                                    @else
                                                          <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Localidad de Residencia{{ old('admin_state_residence_id') }} </label>
                                        <select class="form-control" id="admin_state_residence_id" name="admin_state_residence_id">
                                            @foreach ($states_residence AS $st)
                                                @if (old('admin_state_residence_id', $cliente->state_residence->id) == $st->id)
                                                      <option value="{{ $st->id }}" selected="selected">{{ $st->name }}</option>
                                                @else
                                                      <option value="{{ $st->id }}">{{ $st->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <input id="old_admin_state_residence_id" type="hidden" value="{{ old('admin_state_residence_id') }}" />
                                </div>
                            </div>

                            {{-- UBICACION DE ENVIO --}}
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Provincia de Envío</label>
                                        <select class="form-control" id="admin_province_shipping_id" name="admin_province_shipping_id">
                                            @foreach ($cliente->state_shipping->province->all() AS $prov)
                                                @if (old('admin_province_shipping_id', $cliente->state_shipping->province->id) == $prov->id)
                                                    <option value="{{ $prov->id }}" selected="selected">{{ $prov->name }}</option>
                                                @else
                                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Localidad de Envío</label>
                                        <select class="form-control" id="admin_state_shipping_id" name="admin_state_shipping_id">
                                            @foreach ($states_shipping AS $st)
                                                @if (old('admin_state_shipping_id', $cliente->state_shipping->id) == $st->id)
                                                      <option value="{{ $st->id }}" selected="selected">{{ $st->name }}</option>
                                                @else
                                                      <option value="{{ $st->id }}">{{ $st->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Comparsa a la que pertenece</label>
                                        <select class="form-control" id="admin_comparsas_id" name="admin_comparsas_id">
                                            @if (is_null($cliente->comparsa))
                                                <option value="null" selected="selected">No Pertenesco a Ninguna . . . .</option>
                                            @else
                                                <option value="null">No Pertenesco a Ninguna . . . .</option>
                                            @endif

                                            @foreach ($admin_comparsas_id as $comp)
                                                @if (!is_null($cliente->comparsa) && old('admin_comparsas_id', $cliente->comparsa->id) == $comp['id'])
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
                                        <textarea type="text" class="form-control" rows="5" name="observations">{{ old('observations', $cliente->observations) }}</textarea>
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





