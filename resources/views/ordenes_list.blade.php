@extends('adminlte::page')

@section('htmlheader_title')
    Nueva Cotizacion
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    LISTA DE ORDENES:
                        <strong>
                        @if ($status == null)
                            [ TODAS ]
                        @elseif ($status == 'abiertas')
                            [ ABIERTAS ]
                        @elseif ($status == 'abiertas-esperando-instrumentos')
                            [ ABIERTAS ESPERANDO INSTRUMENTOS ]
                        @elseif ($status == 'cerradas')
                            [ CERRADAS ]
                        @endif
                        </strong>
                    |
                    <a href="{{ url('ordenes/abiertas') }}" >
                        <button type="button" class="btn btn-info">ABIERTAS</button>
                    </a>
                    ||
                    <a href="{{ url('ordenes/abiertas-esperando-instrumentos') }}" >
                        <button type="button" class="btn btn-info">ABIERTAS ESPERANDO INSTRUMENTOS</button>
                    </a>
                    ||

                    <a href="{{ url('ordenes/cerradas') }}">
                        <button type="button" class="btn btn-info">CERRADAS</button>
                    </a>
                    ||

                    <a href="{{ url('ordenes') }}">
                        <button type="button" class="btn btn-info">TODAS</button>
                    </a>
                </h3>
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
                                            Fecha Creación
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Fecha Pago
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Cliente
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            WhatsApp
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Items
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Total
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Abonado
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
                                    @forelse ( $orders as $order)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $order->number }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}
                                            </td>
                                            <td>
                                                @if ($order->date_cash != null)
                                                    {{ Carbon\Carbon::parse($order->date_cash)->toFormattedDateString() }}
                                                @elseif ($order->date_mp != null)
                                                    {{ Carbon\Carbon::parse($order->date_mp)->toFormattedDateString() }}
                                                @elseif ($order->date_ml != null)
                                                    {{ Carbon\Carbon::parse($order->date_ml)->toFormattedDateString() }}
                                                @else
                                                    Aún no abonaron
                                                @endif
                                            </td>
                                            <td>{{ $order->client->name . ' ' . $order->client->last_name }}</td>
                                            <td>{{ $order->client->user_whatsapp }}</td>
                                            <td title="{{ $order->view_hover_products() }}">{{ $order->cantItems }}</td>
                                            <td>{{ $order->total_cash }}</td>
                                            <td title="{{ $order->view_hover_private_notes() }}">{{ $order->status }}</td>
                                            <td>{{ $order->quickStatus }}</td>
                                            <td>
                                                @if ( $order->isSetExternalLink )
                                                    <a href="{{ url( "clientes/orden/$order->externalLink" ) }}" target="_blank" title="Ver la Cotización" >
                                                        Ver Orden
                                                    </a>
                                                @else
                                                    No está el link.
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url( "orden/editar/$order->id" ) }}">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                                @if ( !$order->isSetExternalLink )
                                                    <a href="#" class="generate_order_link" title="Generar Link Externo" data-idorder="{{ $order->id }}" >
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
                            {{ $orders->render() }}
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










