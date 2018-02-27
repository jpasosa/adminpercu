@extends('adminlte::page')

@section('htmlheader_title')
    Change Title here!
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-success box-solid">
                    <div class="box-body">
                        <form method="POST" action="{{ url("recalcular_precios") }}">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                            <span class="label label-success">CONTADO</span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Sugerido</label>
                                        <input type="text" class="form-control" id="cont_sugerido" placeholder="120" value="{{ $prices['cash']['sugerido'] }}" readonly="readonly">
                                        <input type="hidden" name="cash_sugerido" value="{{ $prices['cash']['sugerido'] }}" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Real</label>
                                        <input type="text" name="cash_real" class="form-control" id="cont_real" placeholder="120" value="{{ $prices['cash']['real'] }}">
                                        <input type="hidden" name="cash_real_anterior" value="{{ $prices['cash']['real'] }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ganancia</label>
                                        <input type="text" class="form-control" id="cont_ganancia" placeholder="120" value="{{ $prices['cash']['ganancia'] }}">
                                        <input type="hidden" name="cash_ganancia" value="{{ $prices['cash']['ganancia'] }}" />
                                    </div>
                                </div>
                            </div>


                            {{-- MERCADOPAGO --}}
                            <span class="label label-info">MERCADOPAGO</span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Sugerido</label>
                                        <input type="text" class="form-control" id="mp_sugerido" placeholder="120" value="{{ $prices['MP']['sugerido'] }}" readonly="readonly">
                                        <input type="hidden" name="mp_sugerido" value="{{ $prices['MP']['sugerido'] }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Real</label>
                                        <input type="text" name="mp_real" class="form-control" id="mp_real" placeholder="120" value="{{ $prices['MP']['real'] }}" >
                                        <input type="hidden" name="mp_real_anterior" value="{{ $prices['MP']['real'] }}" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ganancia</label>
                                        <input type="text" class="form-control" id="mp_ganancia" placeholder="120" value="{{ $prices['MP']['ganancia'] }}" >
                                        <input type="hidden" name="mp_ganancia" value="{{ $prices['MP']['ganancia'] }}" />
                                    </div>
                                </div>
                            </div>


                            {{-- MERCADOLIBRE --}}
                            <span class="label label-warning">MERCADOLIBRE</span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Sugerido</label>
                                        <input type="text" class="form-control" id="ml_sugerido" placeholder="120" value="{{ $prices['ML']['sugerido'] }}" readonly="readonly">
                                        <input type="hidden" name="ml_sugerido" value="{{ $prices['ML']['sugerido'] }}" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Real</label>
                                        <input type="text" name="ml_real" class="form-control" id="ml_real" placeholder="120" value="{{ $prices['ML']['real'] }}" >
                                        <input type="hidden" name="ml_real_anterior" value="{{ $prices['ML']['real'] }}" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ganancia</label>
                                        <input type="text" class="form-control" id="ml_ganancia" placeholder="120" value="{{ $prices['ML']['ganancia'] }}">
                                        <input type="hidden" name="ml_ganancia" value="{{ $prices['ML']['ganancia'] }}" />
                                    </div>
                                </div>
                            </div>



                            <input type="submit" class="btn btn-info" value="Re Calcular">

                            <a href="{{ url('precios') }}">
                                <input type="button" class="btn btn-info" value="Calcular Nuevo Precios">
                            </a>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





