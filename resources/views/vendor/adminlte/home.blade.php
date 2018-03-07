@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
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
			<div class="col-md-8 col-md-offset-2">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Home</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div>

						</div>
						{{ trans('adminlte_lang::message.logged') }}. Start creating your amazing application!
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
