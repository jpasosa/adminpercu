@extends('adminlte::page')

@section('htmlheader_title')
    Nueva Comparsa
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <form method="POST" action="{{ url("comparsa/editar/$comparsa->id") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <span class="label label-success">Edición de la Comparsa</span>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre de la Comparsa</label>
                                        <input type="text" class="form-control" id="" name="name_comparsa" placeholder="Indique el nombre de la comparsa" value="{{ old('name_comparsa', $comparsa->name_comparsa) }}"  >
                                    </div>
                                    @if( $errors->has('name_comparsa') )
                                        <p><code>{{ $errors->first('name_comparsa') }}</code></p>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre de la Bateria</label>
                                        <input type="text" class="form-control" id="" name="name_bateria" placeholder="Indique el nombre de la bateria" value="{{ old('name_bateria', $comparsa->name_bateria) }}"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Provincia</label>
                                        <select class="form-control" id="province" name="admin_province_id">
                                        $comparsa->state->province->id
                                                @foreach ($comparsa->state->province->nadmin_province_id AS $prov)
                                                    @if (old('admin_province_id', $comparsa->admin_province_id) == $prov->id)
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
                                        <label for="exampleFormControlInput1">Localidad</label>
                                        <select class="form-control" id="state" name="admin_state_id">
                                            <option value="">Selecciones antes la provincia, luego la localidad . . .</option>
                                        </select>
                                    </div>
                                    @if( $errors->has('admin_state_id') )
                                        <p><code>{{ $errors->first('admin_state_id') }}</code></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Pagina Facebook</label>
                                        <input type="text" class="form-control" id="" name="facebook_page" placeholder="facebook.com/comparsa-" value="{{ old('facebook_page', $comparsa->facebook_page) }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Cantidad de Miembros</label>
                                        <input type="number" class="form-control" id="" name="members_cant" placeholder="4000" value="{{ old('members_cant', $comparsa->members_cant) }}" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Se puede publicar ? </label>
                                        <div class="form-group">
                                            <select class="form-control" id="sel1" name="can_publish">
                                                @if (old('can_publish', $comparsa->can_publish) == '1')
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
                                        <label for="exampleFormControlInput1">Observaciones</label>
                                        <textarea type="text" class="form-control" rows="5" name="observations">{{ old('observations', $comparsa->observations) }}</textarea>
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





