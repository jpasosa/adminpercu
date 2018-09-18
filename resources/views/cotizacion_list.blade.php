@extends('adminlte::page')

@section('htmlheader_title')
    Nueva Cotizacion
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Cotizaciones</h3>
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
                                            Número
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Cliente
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Titulo
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Fecha Creación
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Fecha Edición
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            CantItems
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Total
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Link
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $quotations as $quot)
                                        <tr role="row" class="odd" id="id_quot_{{ $quot->id }}">
                                            <td class="sorting_1">{{ $quot->number }}</td>
                                            <td>{{ $quot->client->name . ' ' . $quot->client->last_name }}</td>
                                            <td>
                                                @if( $quot->title != null )
                                                    {{ $quot->title }}
                                                @endif
                                            </td>
                                            <td>{{ $quot->created_at }}</td>
                                            <td>{{ $quot->updated_at }}</td>
                                            <td>{{ $quot->cantItems }}</td>
                                            <td>{{ $quot->total }}</td>
                                            <td>
                                                @if ( $quot->isSetExternalLink )
                                                    <a href="{{ url( "clientes/cotizacion/$quot->externalLink" ) }}" target="_blank" title="Ver la Cotización" >
                                                        Ver Cotización
                                                    </a>
                                                @else
                                                    No está el link.
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url( "cotizacion/editar/$quot->id" ) }}" title="Editar" >
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                                <a href="#" class="erase_quot" title="Eliminar" data-id_quot="{{ $quot->id }}" style="color: #e86f6f;" >
                                                    <i class="fa fa-fw fa-eraser"></i>
                                                </a>
                                                @if ( !$quot->isSetExternalLink )
                                                    <a href="#" class="generate_link" title="Generar Link Externo" data-idquotation="{{ $quot->id }}" >
                                                        <i class="fa fa-fw fa-external-link-square"></i>
                                                    </a>
                                                @endif
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
                            {{ $quotations->render() }}
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










