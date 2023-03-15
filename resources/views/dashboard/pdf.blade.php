@php
$fechaActual = new \DateTime();
$fecha = $month;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <style>
        body{
            font-family: sans-serif !important;
            font-size: 14px;
        }
        .titulo{
            font-weight: 600;
            font-size: 18px;
            font-family: sans-serif;
        }
        .cabecera{
            background: #0aa622;
            color: #ffffff;
        }
        .cabecera-2{
            background: #c4edca;
            color: #000000;
        }
        th{
            padding:8px 15px;
        }
        td{
            padding: 8px 15px;     
        }
        tbody{
            background: #effaf1;
        }
        p{
            margin-top: -1px 0px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <img src="{{ public_path('/img/dashboard-logo.png')}}" width="150px" alt="">
                    </div>
                    <div class="card-header">
                        <div style="text-align:center; margin-bottom:10px">
                            <span class="titulo">
                                Instrucciones de Pago
                            </span>
                        </div>
                        <hr>
                        <div>
                            <p><strong>Cliente:</strong> Soluciones de Préstamo JOALPE</p>
                            <p><strong>Reporte:</strong> {{$fecha->format('F-Y')}}</p>
                            <p><strong>Destinatario:</strong> Guaranteed Escrow Company GEC- RNC 1-31-93519-2<br>Banco BDI - Cuenta de Ahorros No. 4010151891</p>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="cabecera">
                                    <tr>
                                        <th>Día de Pago</th>
										<th>Solicitudes</th>
										<th>Monto</th>
										<th>Balance Pendiente</th>
                                    </tr>
                                </thead>
                                <thead class="cabecera-2">
                                    <tr>
                                        <th>
                                        @php
                                            // Create a new DateTime object
                                            $datetime = $fecha;                      
                                            // Set the day of the month to the 10th
                                            $datetime->setDate($datetime->format('Y'), $datetime->format('m'), 10);
                                            // Format the DateTime object to display the date in your desired format
                                            echo $datetime->format('d-m-Y'); // Output: e.g. 2023-03-10
                                        @endphp    
                                        </th>
                                        <th style="width: 225px;">
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
                                <thead class="cabecera-2">
                                    <tr>
                                        <th>
                                            @php
                                            // Create a new DateTime object
                                            $datetime = $fecha;                      
                                            // Set the day of the month to the 10th
                                            $datetime->setDate($datetime->format('Y'), $datetime->format('m'), 20);
                                            // Format the DateTime object to display the date in your desired format
                                            echo $datetime->format('d-m-Y'); // Output: e.g. 2023-03-10
                                        @endphp    
                                        </th>
                                        <th style="width: 225px;">
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
                                <tfoot class="cabecera">
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
    </div>
</body>
</html>
