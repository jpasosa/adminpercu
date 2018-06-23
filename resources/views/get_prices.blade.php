@extends('adminlte::page')

@section('htmlheader_title')
	Calcular Precios
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
				<div class="box box-success box-solid">
                    <div class="box-body">
                        <form method="POST" action="{{ url("calcular_precios") }}">
                            {{ csrf_field() }}
                            <div class="col-md-2 col-md-offset-1">
                                {{-- PRECIO DE LISTA DEL PRODUCTO --}}
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Precio de Lista</label>
                                    <input type="number" class="form-control" name="price" id="precio" placeholder="120">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Descuento</label>
                                    <input type="number" class="form-control" name="discount" id="descuento" placeholder="120" value="20">
                                </div>
                                <input type="submit" class="btn btn-info" value="Calcular Precios">
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection





