@extends('layouts.app')

@section('template_title')
    Solicitude
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Solicitude') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
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
                                        <th>No</th>
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
										<th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitude)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><a class="" href="{{ route('solicitudes.show',$solicitude->id) }}">{{ $solicitude->referencia }}</a></td>
                                            
											<td>{{ $solicitude->moneda }}</td>
											<td>{{ number_format($solicitude->monto, 2, '.', ',')}}</td>
											<td>{{ $solicitude->int_anual }}</td>
											<td>{{ $solicitude->int_comision }}</td>
											<td>{{ $solicitude->cuotas }}</td>
											<td>{{ $solicitude->periodo }}</td>
											<td>{{ $solicitude->fecha_inicial }}</td>
											<td>{{ $solicitude->fecha_final }}</td>
											<td>{{ $solicitude->modalidad }}</td>
											<td>{{ $solicitude->cant_inversionistas }}</td>
											<td>{{ $solicitude->estado }}</td>
                                            <td>
                                                <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('solicitudes.edit',$solicitude->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $solicitudes->links() !!}
            </div>
        </div>
    </div>
@endsection
