@php
$json = json_decode($solicitude->tabla_amortizacion, true);
$json2 = json_decode($solicitude->tabla_inversionistas, true);
$k = 1;
@endphp

@extends('layouts.app')

@section('template_title')
    {{ $solicitude->name ?? 'Show Solicitude' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('solicitudes.index') }}"> Back</a>
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Información General</span>
                        </div>
                        <div class="float-right">
                            <span>{{ $solicitude->estado }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Referencia</th>
                                        
										<th>Moneda</th>
										<th>Monto</th>
										<th>% Anual</th>
										<th>% Comision</th>
										<th>Cuotas</th>
										<th>Periodo</th>
										<th>Fecha Inicial</th>
										<th>Fecha Final</th>
										<th>Modalidad</th>
										<th>Inversionistas</th>
										<th>Día de Pago</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>{{ $solicitude->referencia }}</td>
											<td>{{ $solicitude->moneda }}</td>
											<td>{{ number_format($solicitude->monto, 2, '.', ',') }}</td>
											<td>{{ $solicitude->int_anual }}</td>
											<td>{{ $solicitude->int_comision }}</td>
											<td>{{ $solicitude->cuotas }}</td>
											<td>{{ $solicitude->periodo }}</td>
											<td>{{ $solicitude->fecha_inicial }}</td>
											<td>{{ $solicitude->fecha_final }}</td>
											<td>{{ $solicitude->modalidad }}</td>
											<td>{{ $solicitude->cant_inversionistas }}</td>
											<td>{{ $solicitude->diapago }}</td>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Tabla de Solicitud</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Fecha de Pago</th>
										<th>Saldo Inicial</th>
										<th>Capital</th>
										<th>% Inversionista</th>
										<th>% Comision</th>
										<th>Total Cuota a Pagar</th>
										<th>Balance</th>
                                        <th>Pagado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $json as $object)
                                    <tr>
                                        <td>{{ $object['date'] }}</td>
                                        <td>{{ number_format($object['initialbalance'], 2, '.', ',')  }}</td>
                                        <td>{{ number_format($object['capitalAmount'], 2, '.', ',')  }}</td>
                                        <td>{{ number_format($object['interestAmount'], 2, '.', ',')  }}</td>
                                        <td>{{ number_format($object['comision'], 2, '.', ',')  }}</td>
                                        <td>{{ number_format($object['toReceive'], 2, '.', ',')  }}</td>
                                        <td>{{ number_format($object['balance'], 2, '.', ',')  }}</td>
                                        <td>
                                                @php
                                                if($object['isPaid']){
                                                    echo('<span style="color: green;">Pagado</span>');
                                                }else{
                                                    echo('<span>No Pagado</span>');
                                                }
                                                @endphp
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td></td>
                                        <td><strong>
                                        @php
                                            $total = 0;
                                            foreach($json as $value){
                                                    $total = $value['capitalAmount'] + $total;
                                            }
                                            echo(number_format($total, 2, '.', ','));
                                        @endphp
                                        </strong>
                                        </td>
                                        <td><strong>
                                            @php
                                                $total = 0;
                                                foreach($json as $value){
                                                        $total = $value['interestAmount'] + $total;
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </strong>
                                        </td>
                                        <td><strong>
                                            @php
                                                $total = 0;
                                                foreach($json as $value){
                                                        $total = $value['comision'] + $total;
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </strong>
                                        </td>
                                        <td><strong>
                                            @php
                                                $total = 0;
                                                foreach($json as $value){
                                                        $total = $value['toReceive'] + $total;
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </strong>
                                        </td>

                                        <td>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
                
                @php
                $i = 1;
                @endphp

                @foreach ($json2 as $objects)
                @php
                $key = 'cliente'.$i++;
                @endphp

                <div class="card mt-5">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Tabla de Solicitud - {{ $solicitude->$key->nombre }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha de Pago</th>
							    			<th>Saldo Inicial</th>
							    			<th>Capital</th>
							    			<th>Interés</th>
							    			<th>Total Cuota a Recibir</th>
							    			<th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $j = 1;
                                        @endphp
                                        @foreach ( $objects as $object)
                                        <tr>
                                            <td>{{ $object['date'] }}</td>
                                            <td>{{ number_format($object['initialbalance'], 2, '.', ',')  }}</td>
                                            <td>{{ number_format($object['capitalAmount'], 2, '.', ',')  }}</td>
                                            <td>{{ number_format($object['interestAmount'], 2, '.', ',')  }}</td>
                                            <td>{{ number_format($object['toReceive'], 2, '.', ',')  }}</td>
                                            <td>{{ number_format($object['balance'], 2, '.', ',')  }}</td>
                                        </tr>
                                        @endforeach
                                        @php
                                            $k++;
                                        @endphp
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td></td>
                                            <td><strong>
                                            @php
                                                $total = 0;
                                                foreach($objects as $value){
                                                        $total = $value['capitalAmount'] + $total;
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </strong>
                                            </td>
                                            <td><strong>
                                                @php
                                                    $total = 0;
                                                    foreach($objects as $value){
                                                            $total = $value['interestAmount'] + $total;
                                                    }
                                                    echo(number_format($total, 2, '.', ','));
                                                @endphp
                                                </strong>
                                            </td>
                                            <td><strong>
                                                @php
                                                    $total = 0;
                                                    foreach($objects as $value){
                                                            $total = $value['toReceive'] + $total;
                                                    }
                                                    echo(number_format($total, 2, '.', ','));
                                                @endphp
                                                </strong>
                                            </td>
                                            <td>
                                            </td>

                                            <td>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </section>
@endsection
