@extends('adminlte::page')

@section('htmlheader_title')
    Nuevo Cliente
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de los Clientes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                            Nombre
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Whatsapp
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            User MercadoLibre
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Ubicación Envío
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $clients as $client)
                                        <tr role="row" class="odd" id="id_cliente_{{ $client->id }}">
                                            <td class="sorting_1">{{ $client->name }}</td>
                                            <td>{{ $client->user_whatsapp }}</td>
                                            <td>{{ $client->user_ml }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->state_shipping->name . ' - ' . $client->state_shipping->province->name . ' - ' . $client->state_shipping->cp }}</td>
                                            <td>
                                                <a href="{{ url( "cliente/$client->id" ) }}">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                                <a href="{{ url( "cliente/editar/$client->id" ) }}">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                                <a href="#" class="erase_cliente" data-id_cliente="{{ $client->id }}" >
                                                    <i class="fa fa-fw fa-eraser"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr role="row" class="odd">
                                            No existen registros . . . .
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            {{ $clients->render() }}
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




<script type="text/javascript">







</script>










