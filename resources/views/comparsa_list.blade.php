@extends('adminlte::page')

@section('htmlheader_title')
    Nuevo Cliente
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Comparsas</h3>
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
                                            Nombre Comparsa
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Nombre Bateria
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Facebook
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Cant.Amigos
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Ubicación
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $comparsas as $comp)
                                        <tr role="row" class="odd" id="id_comparsa_{{ $comp->id }}">
                                            <td class="sorting_1">{{ $comp->name_comparsa }}</td>
                                            <td>{{ $comp->name_bateria }}</td>
                                            <td>{{ $comp->facebook_page }}</td>
                                            <td>{{ $comp->members_cant }}</td>
                                            <td>{{ $comp->state->name . ' - ' . $comp->state->province->name . ' - ' . $comp->state->cp }}</td>
                                            <td>ubicacion</td>
                                            <td>
                                                <a href="{{ url( "comparsa/$comp->id" ) }}">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                                <a href="{{ url( "comparsa/editar/$comp->id" ) }}">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                                <a href="#" class="erase_comparsa" data-id_comparsa="{{ $comp->id }}" style="color: #e86f6f;" >
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
                            {{ $comparsas->render() }}
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










