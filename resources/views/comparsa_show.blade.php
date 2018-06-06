@extends('adminlte::page')

@section('htmlheader_title')
    Detalles del Cliente
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-success box-solid">
                    <div class="box-body">
                            {{ csrf_field() }}
                            {{-- AL CONTADO --}}
                                <span class="label label-success">DETALLES DE LA COMPARSA</span><br>
                            <div class="row">
                            <br>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Nombre de la Comparsa: <b>{{ $comparsa->name_comparsa }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Nombre de la bateria: <b>{{ $comparsa->name_bateria }}</b></h4>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Ubicación:
                                        <b>{{ $comparsa->state->name . ' - ' . $comparsa->state->province->name . ' - ' . $comparsa->state->cp }}</b></h4>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Facebook: <b>{{ $comparsa->facebook_page }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Cantidad de Miembros: <b>{{ $comparsa->members_cant }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Se puede publicar ?
                                        @if( $comparsa->can_publish == true )
                                            <b>SI</b>
                                        @else
                                            <b>NO</b>
                                        @endif
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Observaciones: <b>{{ $comparsa->observations }}</b></h4>
                                </div>
                            </div>

                    </div>
                </div>

                    <p><a href="{{ url('comparsas') }}"><span class="label label-info">VOLVER LISTA DE COMPARSAS</span></a></p>

            </div>
        </div>
    </div>
@endsection




<script type="text/javascript">







</script>





