@php
    $json = json_decode($solicitude->tabla_amortizacion, true);
    $k = 1;
@endphp
@extends('layouts.app')

@section('template_title')
    Update Solicitude
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Solicitude</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('solicitudes.update', $solicitude->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('solicitude.form')
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
                                                        <input type="checkbox"
                                                            @php
                                                            if($object['isPaid']){
                                                                echo('checked name="paid-'.$k++.'"');
                                                            }else{
                                                                echo('name="paid-'.$k++.'"');
                                                            }
                                                            @endphp
                                                        >
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

                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script type="text/javascript">
    const submit = document.getElementById('submit');

    submit.addEventListener('click', (e) => {
        //e.preventDefault();
        let array = [];
        const info = document.querySelectorAll('input[type=checkbox]');
        
        for (const value of info) {
            let key = value.checked;    
            array.push(key);
        }
        console.log(array); 
    })
</script>