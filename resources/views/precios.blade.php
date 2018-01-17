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
                        {!! Form::open(['class' => 'form']) !!}

                            {{-- PRECIO DE LISTA DEL PRODUCTO --}}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Precio de Lista</label>
                                <input type="number" class="form-control" id="precio" placeholder="120">
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="gope">
                                <label class="form-check-label" for="defaultCheck1">
                                    Marca GOPE ?
                                </label>
                            </div>

                            {{-- AL CONTADO --}}
                            <span class="label label-success">CONTADO</span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Sugerido</label>
                                        <input type="number" class="form-control" id="cont_sugerido" placeholder="120" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Real</label>
                                        <input type="number" class="form-control" id="cont_real" placeholder="120">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ganancia</label>
                                        <input type="number" class="form-control" id="cont_ganancia" placeholder="120">
                                    </div>
                                </div>
                            </div>


                            {{-- MERCADOPAGO --}}
                            <span class="label label-info">MERCADOPAGO</span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Sugerido</label>
                                        <input type="number" class="form-control" id="mp_sugerido" placeholder="120" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Real</label>
                                        <input type="number" class="form-control" id="mp_real" placeholder="120">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ganancia</label>
                                        <input type="number" class="form-control" id="mp_ganancia" placeholder="120">
                                    </div>
                                </div>
                            </div>


                            {{-- MERCADOLIBRE --}}
                            <span class="label label-warning">MERCADOLIBRE</span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Sugerido</label>
                                        <input type="number" class="form-control" id="ml_sugerido" placeholder="120" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Real</label>
                                        <input type="number" class="form-control" id="ml_real" placeholder="120">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Ganancia</label>
                                        <input type="number" class="form-control" id="ml_ganancia" placeholder="120">
                                    </div>
                                </div>
                            </div>






                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection





