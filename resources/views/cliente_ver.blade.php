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
                                <span class="label label-success">DETALLES DEL CLIENTE</span><br>
                            <div class="row">
                            <br>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Nombre: <b>{{ $client->name . ' ' . $client->last_name}}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Usuario de MercadoLibre: <b>{{ $client->user_ml }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Email: <b>{{ $client->email }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>DNI: <b>{{ $client->dni }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Teléfono: <b>{{ $client->phone }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Por Donde Nos Conociste?: <b>{{ $client->marketing }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Facebook: <b>{{ $client->face }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Amigos en Face:
                                        @if( $client->friends == true )
                                            <b>SI</b>
                                        @else
                                            <b>NO</b>
                                        @endif
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Ya nos compró?:
                                        @if( $client->ya_nos_compro == true )
                                            <b>SI</b>
                                        @else
                                            <b>NO</b>
                                        @endif
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Lugar De Residencia:
                                        <b>{{ $client->state_residence->name . ' - ' . $client->state_residence->province->name . ' - ' . $client->state_residence->cp }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Lugar De Envíos:
                                        <b>{{ $client->state_shipping->name . ' - ' . $client->state_shipping->province->name . ' - ' . $client->state_shipping->cp }}</b></h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>
                                        Comparsa:
                                        <b>
                                        @if( !is_null($client->comparsa) )
                                            {{ $client->comparsa->name_comparsa }}
                                        @endif
                                        </b>
                                    </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <h4>Observaciones: <b>{{ $client->observations }}</b></h4>
                                </div>
                            </div>
                    </div>
                </div>

                    <p><a href="{{ url('clientes') }}"><span class="label label-info">VOLVER LISTA DE CLIENTES</span></a></p>

            </div>
        </div>
    </div>
@endsection




<script type="text/javascript">







</script>





