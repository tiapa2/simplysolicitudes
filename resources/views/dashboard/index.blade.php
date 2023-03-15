@php
$fechaActual = new \DateTime();
$facturacrowd = 0;
foreach ($array as $key) {
    $facturacrowd = $key[0]->comision + $facturacrowd;
}
$facturacrowsinit = ($facturacrowd * 0.82);
$facturaescrow = (($facturacrowd * 0.82) * 0.25) * 1.18;
$facturaescrowsinit = (($facturacrowd * 0.82) * 0.25);

@endphp
@extends('layouts.app')

@section('template_title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row" style="justify-content: center;">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Reporte General de Solicitudes
                            </span>
                            <span class="float-right">
                                Fecha Actual: {{$fechaActual->format('F')}} {{$fechaActual->format('Y')}}
                            </span>
                            <form action="/dashboard/pdf" class="d-flex" method="GET">
                                <input type="month" name='month' id='month' class="form-control" required>
                                <button class="form-control btn btn-primary">Exportar PDF</button>
                            </form>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Vencimiento de Pago</th>
										<th>Solicitudes</th>
										<th>Monto</th>
										<th>Balance Pendiente</th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th>
                                        @php
                                            // Create a new DateTime object
                                            $datetime = new \DateTime();                      
                                            // Set the day of the month to the 10th
                                            $datetime->setDate($datetime->format('Y'), $datetime->format('m'), 10);
                                            // Format the DateTime object to display the date in your desired format
                                            echo $datetime->format('d-m-Y'); // Output: e.g. 2023-03-10
                                        @endphp    
                                        </th>
                                        <th>
                                        @foreach ($array as $value)
                                            @if ($value[0]->diapago == 'Día 10')
                                                {{$value[0]->referencia}} | 
                                            @endif
                                        @endforeach    
                                        </th>
                                        <th>
                                        @php
                                            $total = 0;
                                            foreach($array as $value){
                                                if($value[0]->diapago == 'Día 10'){
                                                    $total = $value[0]->toReceive + $total;
                                                }
                                            }
                                            echo(number_format($total, 2, '.', ','));
                                        @endphp
                                        </th>
                                        <th>
                                         @php
                                            $total = 0;
                                            foreach($array as $value){
                                                if($value[0]->diapago == 'Día 10'){
                                                    $total = $value[0]->balance + $total;
                                                }
                                            }
                                            echo(number_format($total, 2, '.', ','));
                                        @endphp
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($array as $value)
                                        @if ($value[0]->diapago == 'Día 10')
                                            <tr>
                                                <td></td>
                                                <td>{{$value[0]->referencia}}: Cuota {{$value[0]->sequence}}</td>
                                                <td>{{number_format($value[0]->toReceive, 2, '.', ',') }}</td>
                                                <td>{{number_format($value[0]->balance, 2, '.', ',') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr>
                                        <th>
                                            @php
                                            // Create a new DateTime object
                                            $datetime = new \DateTime();                      
                                            // Set the day of the month to the 10th
                                            $datetime->setDate($datetime->format('Y'), $datetime->format('m'), 20);
                                            // Format the DateTime object to display the date in your desired format
                                            echo $datetime->format('d-m-Y'); // Output: e.g. 2023-03-10
                                        @endphp    
                                        </th>
                                        <th>
                                        @foreach ($array as $value)
                                            @if ($value[0]->diapago == 'Día 20')
                                                {{$value[0]->referencia}} | 
                                            @endif
                                        @endforeach    
                                        </th>
                                        <th>
                                            @php
                                                $total = 0;
                                                foreach($array as $value){
                                                    if($value[0]->diapago == 'Día 20'){
                                                        $total = $value[0]->toReceive + $total;
                                                    }
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </th>
                                            <th>
                                            @php
                                                $total = 0;
                                                foreach($array as $value){
                                                    if($value[0]->diapago == 'Día 20'){
                                                        $total = $value[0]->balance + $total;
                                                    }
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($array as $value)
                                        @if ($value[0]->diapago == 'Día 20')
                                            <tr>
                                                <td></td>
                                                <td>{{$value[0]->referencia}}: Cuota {{$value[0]->sequence}}</td>
                                                <td>{{number_format($value[0]->toReceive, 2, '.', ',')}}</td>
                                                <td>{{number_format($value[0]->balance, 2, '.', ',') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Balance pendiente luego de pago mes actual</td>
                                        <td>
                                        @php
                                            $total = 0;
                                            foreach($array as $value){
                                                    $total = $value[0]->balance + $total;
                                            }
                                            echo(number_format($total, 2, '.', ','));
                                        @endphp
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de inversipnistas-->
        <div class="row mt-4" style="justify-content: center;">
            <div class="col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Reporte por Inversionistas
                            </span>
                            <span class="float-right">
                                Fecha Actual: {{$fechaActual->format('F')}} {{$fechaActual->format('Y')}}
                            </span>
                            <form action="/dashboard/pdf2" class="d-flex" method="GET">
                                <input type="month" name='month2' id='month2' class="form-control" required>
                                <button class="form-control btn btn-primary">Exportar PDF</button>
                            </form>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Vencimiento de Pago</th>
										<th>Solicitudes</th>
										<th>Monto</th>
                                        <th>Cuota</th>
                                    </tr>
                                </thead>

                                <thead>
                                    <tr>
                                        <th>
                                        @php
                                            // Create a new DateTime object
                                            $datetime = new \DateTime();                      
                                            // Set the day of the month to the 10th
                                            $datetime->setDate($datetime->format('Y'), $datetime->format('m'), 10);
                                            // Format the DateTime object to display the date in your desired format
                                            echo $datetime->format('d-m-Y'); // Output: e.g. 2023-03-10
                                        @endphp    
                                        </th>
                                        <th>
                                            Resumen por Inversionista    
                                        </th>
                                        <th>
                                            <strong>
                                            @php
                                                $total = 0;
                                                foreach($array2 as $array){
                                                    foreach ($array as $value) {
                                                        if($value[0]->diapago == 'Día 10'){
                                                            $total = $value[0]->toReceive + $total;
                                                        }
                                                    }
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </strong>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($array2 as $array3)
                                    <tbody>
                                        @foreach ($array3 as $value)
                                            @if ($value[0]->diapago == 'Día 10')
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td>{{$value[0]->referencia}}: 
                                                    @foreach ($clientes as $cliente)
                                                        @php
                                                            if ($cliente->id == $value[0]->inversionista_id) {
                                                                echo($cliente->nombre);
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    </td>
                                                    <td>{{number_format($value[0]->toReceive, 2, '.', ',') }}</td>
                                                    <td>Cuota {{$value[0]->sequence}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                @endforeach

                                <thead>
                                    <tr>
                                        <th>
                                        @php
                                            // Create a new DateTime object
                                            $datetime = new \DateTime();                      
                                            // Set the day of the month to the 10th
                                            $datetime->setDate($datetime->format('Y'), $datetime->format('m'), 20);
                                            // Format the DateTime object to display the date in your desired format
                                            echo $datetime->format('d-m-Y'); // Output: e.g. 2023-03-10
                                        @endphp    
                                        </th>
                                        <th>
                                            Resumen por Inversionista    
                                        </th>
                                        <th>
                                            <strong>
                                            @php
                                                $total = 0;
                                                foreach($array2 as $array){
                                                    foreach ($array as $value) {
                                                        if($value[0]->diapago == 'Día 20'){
                                                            $total = $value[0]->toReceive + $total;
                                                        }
                                                    }
                                                }
                                                echo(number_format($total, 2, '.', ','));
                                            @endphp
                                            </strong>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>

                                @foreach ($array2 as $array3)
                                    <tbody>
                                        @foreach ($array3 as $value)
                                            @if ($value[0]->diapago == 'Día 20')
                                                <tr>
                                                    <td>
                                                    </td>
                                                    <td>{{$value[0]->referencia}}: 
                                                    @foreach ($clientes as $cliente)
                                                        @php
                                                            if ($cliente->id == $value[0]->inversionista_id) {
                                                                echo($cliente->nombre);
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    </td>
                                                    <td>{{number_format($value[0]->toReceive, 2, '.', ',') }}</td>
                                                    <td>Cuota {{$value[0]->sequence}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                @endforeach
                                
                                <tfoot >
                                    <tr>
                                        <td colspan="2">Total pagar a Inversionistas</td>
                                        <td>
                                            <strong>
                                                @php
                                                    $total1 = 0;
                                                    foreach($array2 as $array){
                                                        foreach ($array as $value) {
                                                            if($value[0]->diapago == 'Día 10'){
                                                                $total1 = $value[0]->toReceive + $total1;
                                                            }
                                                        }
                                                    }
                                                    $total2 = 0;
                                                    foreach($array2 as $array){
                                                        foreach ($array as $value) {
                                                            if($value[0]->diapago == 'Día 20'){
                                                                $total2 = $value[0]->toReceive + $total2;
                                                            }
                                                        }
                                                    }
                                                    $total = $total1 + $total2;
                                                    echo(number_format($total, 2, '.', ','));
                                                @endphp
                                            </strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Factura Crowrising</td>
                                        <td>
                                            <strong>
                                                Sin ITBIS: {{number_format(($facturacrowsinit), 2, '.', ',') }}
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                Con ITBIS: {{number_format(($facturacrowd), 2, '.', ',') }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Factura GEC</td>
                                        <td>
                                            <strong>
                                                Sin ITBIS: {{number_format(($facturaescrowsinit), 2, '.', ',') }}
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                Con ITBIS: {{number_format(($facturaescrow), 2, '.', ',') }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Factura Crowrising - GEC</td>
                                        <td>
                                            <strong>
                                                Sin ITBIS: {{number_format(($facturacrowsinit - $facturaescrowsinit), 2, '.', ',') }}
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                Con ITBIS: {{number_format(($facturacrowd - $facturaescrow), 2, '.', ',') }}
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
