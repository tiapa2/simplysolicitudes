<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use App\Models\Cliente;
use Illuminate\Http\Request;
/**
 * Class SolicitudeController
 * @package App\Http\Controllers
 */
class SolicitudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitude::paginate();

        return view('solicitude.index', compact('solicitudes'))
            ->with('i', (request()->input('page', 1) - 1) * $solicitudes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitude = new Solicitude();
        $cliente = Cliente::pluck('nombre','id');
        return view('solicitude.create', compact('solicitude', 'cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Solicitude::$rules);

        $solicitude = Solicitude::create($request->all());

        //variables from view
        $diapago = $request->diapago;
        $referencia = $request->referencia;
        $monto = $request->monto;
        $tasa = ($request->int_anual)/100;
        $cuotas = $request->cuotas;
        $comision = ($request->int_comision)/100;
        $cantInversionistas = $request->cant_inversionistas;
        $periodo = $request->periodo;
        $modalidad = $request->modalidad;
        $fecha = $request->fecha_inicial;
        $montosInver = [];
        for ($i=0; $i < $cantInversionistas; $i++) { 
           $key = $i + 1;
            $montoinv = 'monto_inv_'.$key;
            array_push($montosInver ,$request->$montoinv);
        }
        for ($j=0; $j < $cantInversionistas; $j++) { 
            $key = $j + 1;
            $inversionista = 'id_inv_'.$key;
            array_push($inversionistas ,$request->$inversionista);
        }
        $payments = [];
        for ($k=0; $k < $cuotas; $k++) { 
            array_push($payments, false);
        }

        if($modalidad == 'Capital e Interés'){
            $tabla = $this->crearTablaAmortizable($periodo, $tasa, $comision, $monto, $cuotas, $fecha, $referencia, $diapago);
            $tablaGeneral = $this->crearTablaAmortizablePorInversionista($periodo, $tasa, $cuotas,$montosInver, $cantInversionistas, $fecha, $referencia, $diapago, $inversionistas, $payments);
        }else{
            $tabla = $this->crearTablaInteres($periodo, $tasa, $comision, $monto, $cuotas, $fecha, $referencia, $diapago);
            $tablaGeneral = $this->crearTablaInteresPorInversionista($periodo, $tasa, $cuotas,$montosInver, $cantInversionistas, $fecha, $referencia, $diapago, $inversionistas, $payments);
        }

        $solicitude->tabla_amortizacion = $tabla;
        $solicitude->tabla_inversionistas = json_encode($tablaGeneral);

        $solicitude->update($request->all());
   
        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitude = Solicitude::find($id);
        $cliente = Cliente::pluck('nombre','id');

        return view('solicitude.show', compact('solicitude','cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitude = Solicitude::find($id);
        $cliente = Cliente::pluck('nombre','id');

        return view('solicitude.edit', compact('solicitude','cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Solicitude $solicitude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitude $solicitude)
    {
        request()->validate(Solicitude::$rules);

        //variables from view
        $diapago = $request->diapago;
        $referencia = $request->referencia;
        $monto = $request->monto;
        $tasa = ($request->int_anual)/100;
        $cuotas = $request->cuotas;
        $comision = ($request->int_comision)/100;
        $cantInversionistas = $request->cant_inversionistas;
        $periodo = $request->periodo;
        $modalidad = $request->modalidad;
        $fecha = $request->fecha_inicial;
        $montosInver = [];
        for ($i=0; $i < $cantInversionistas; $i++) { 
            $key = $i + 1;
            $montoinv = 'monto_inv_'.$key;
            array_push($montosInver ,$request->$montoinv);
        }
        $inversionistas = [];
        for ($j=0; $j < $cantInversionistas; $j++) { 
            $key = $j + 1;
            $inversionista = 'id_inv_'.$key;
            array_push($inversionistas ,$request->$inversionista);
        }
        $payments = [];
        for ($k=0; $k < $cuotas; $k++) { 
            $key = $k + 1;
            $pago = 'paid-'.$key;
            $value;
            if($request->$pago == 'on'){
                $value = true;
            }else if($request->$pago == null){
                $value = false;
            }
            array_push($payments ,$value);
        }

        if($modalidad == 'Capital e Interés'){
            $tabla = $this->crearTablaAmortizable($periodo, $tasa, $comision, $monto, $cuotas, $fecha, $referencia, $diapago, $payments);
            $tablaGeneral = $this->crearTablaAmortizablePorInversionista($periodo, $tasa, $cuotas,$montosInver, $cantInversionistas, $fecha, $referencia, $diapago, $inversionistas);
        }else{
            $tabla = $this->crearTablaInteres($periodo, $tasa, $comision, $monto, $cuotas, $fecha, $referencia, $diapago, $payments);
            $tablaGeneral = $this->crearTablaInteresPorInversionista($periodo, $tasa, $cuotas,$montosInver, $cantInversionistas, $fecha, $referencia, $diapago, $inversionistas);
        }

        $solicitude->tabla_amortizacion = $tabla;
        $solicitude->tabla_inversionistas = json_encode($tablaGeneral);
        $solicitude->update($request->all());

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $solicitude = Solicitude::find($id)->delete();

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude deleted successfully');
    }

    private function crearTablaAmortizable($periodo, $tasa, $comision, $monto, $cuotas, $fecha, $referencia, $diapago, $payments){
           //Calcular variables
           $pagosPorAno = $periodo;
           $tasaPromedio = ($tasa / $pagosPorAno);
           $tasaSimplyfund = ($comision / $pagosPorAno);
           $cuotaMensual = ($monto * $tasaPromedio) / (1 - pow(1 + $tasaPromedio, - $cuotas));
           $saldoPendiente = $monto;
           $fecha = new \DateTime($fecha);

           //Calcular tabla amortizable general
           $tabla = [];
           for ($i = 0; $i < $cuotas; $i++) {
             $fecha->modify('+1 month');
             $interesMensual = $saldoPendiente * $tasaPromedio;
             $amortizacionCapital = $cuotaMensual - $interesMensual;
             $saldoPendiente = $saldoPendiente - $amortizacionCapital;
             $initialbalance = $saldoPendiente + $amortizacionCapital;
             $obj = new \stdClass;
             $obj->diapago = $diapago;
             $obj->referencia = $referencia;
             $obj->date = $fecha->format('d-m-Y');
             $obj->isPaid = $payments[$i];
             $obj->balance = number_format($saldoPendiente, 2, '.', '');
             $obj->comision = number_format($initialbalance * $tasaSimplyfund, 2, '.', '');
             $obj->sequence = $i + 1;
             $obj->toReceive = number_format(($amortizacionCapital + ($initialbalance * $tasaSimplyfund) + $interesMensual), 2, '.', '');
             $obj->capitalAmount = number_format($amortizacionCapital, 2, '.', '');
             $obj->initialbalance = number_format($initialbalance, 2, '.', '');
             $obj->interestAmount = number_format($interesMensual, 2, '.', '');
             array_push($tabla,$obj);
           }
           return $tabla;    
    }

    private function crearTablaAmortizablePorInversionista($periodo, $tasa, $cuotas,$montosInver, $cantInversionistas, $fecha, $referencia, $diapago, $inversionistas){
        //Calcular variables
        $pagosPorAno = $periodo;
        $tasaPromedio = ($tasa / $pagosPorAno);
    
        //Calcular tabla amortizable por inversionista
        $tablaGeneral = new \stdClass;
        $fechaActual = new \DateTime($fecha);
    
        for ($j = 0; $j < $cantInversionistas; $j++) {
            $monto2 = $montosInver[$j];
            $cuotaMensual2 = ($monto2 * $tasaPromedio) / (1 - pow(1 + $tasaPromedio, - $cuotas));
            $saldoPendiente2 = $monto2;
            $inversionista = $inversionistas[$j];
            $tabla2 = [];
            for ($k = 0; $k < $cuotas; $k++) {
                $fecha2 = clone $fechaActual;
                $fecha2->modify('+' . ($k + 1) . ' month');
                $interesMensual3 = $saldoPendiente2 * $tasaPromedio;
                $amortizacionCapital3 = $cuotaMensual2 - $interesMensual3;
                $saldoPendiente2 = $saldoPendiente2 - $amortizacionCapital3;
                $initialbalance3 = $saldoPendiente2 + $amortizacionCapital3;
    
                $obj2 = new \stdClass;
                $obj2->diapago = $diapago;
                $obj2->referencia = $referencia;
                $obj2->date = $fecha2->format('d-m-Y');
                $obj2->isPaid = false;
                $obj2->balance = number_format($saldoPendiente2, 2, '.', '');
                $obj2->sequence = $k + 1;
                $obj2->toReceive = number_format(($amortizacionCapital3 +  $interesMensual3), 2, '.', '');
                $obj2->capitalAmount = number_format($amortizacionCapital3, 2, '.', '');
                $obj2->initialbalance = number_format($initialbalance3, 2, '.', '');
                $obj2->interestAmount = number_format($interesMensual3, 2, '.', '');
                $obj2->inversionista_id = $inversionista;
                array_push($tabla2,$obj2);
            }
            $key2 = $j + 1;
            $name = 'inv'.$key2;
            $tablaGeneral->$name = $tabla2;
        }
        return $tablaGeneral;
    }

    private function crearTablaInteres($periodo, $tasa, $comision, $monto, $cuotas, $fecha, $referencia, $diapago, $payments){
        //Calcular variables
        $pagosPorAno = $periodo;
        $tasaPromedio = ($tasa / $pagosPorAno);
        $tasaSimplyfund = ($comision / $pagosPorAno);
        $saldoPendiente = $monto;
        $fecha = new \DateTime($fecha);
        //Calcular tabla amortizable general
        $tabla = [];
        for ($i = 1; $i <= $cuotas; $i++) {
          $fecha->modify('+1 month');
          $interesMensual = $saldoPendiente * $tasaPromedio;

          $amortizacionCapital = 0;
          if($i == $cuotas){
          $amortizacionCapital = $saldoPendiente;
          }else{
          $amortizacionCapital = 0; 
          }

          $saldoPendiente = $saldoPendiente - $amortizacionCapital;
          $initialbalance = $saldoPendiente + $amortizacionCapital;
          $obj = new \stdClass;
          $obj->diapago = $diapago;
          $obj->referencia = $referencia;
          $obj->date = $fecha->format('d-m-Y');
          $obj->isPaid = $payments[($i-1)];
          $obj->balance = number_format($saldoPendiente, 2, '.', '');
          $obj->comision = number_format($initialbalance * $tasaSimplyfund, 2, '.', '');
          $obj->sequence = $i;
          $obj->toReceive = number_format(($amortizacionCapital + ($initialbalance * $tasaSimplyfund) + $interesMensual), 2, '.', '');
          $obj->capitalAmount = number_format($amortizacionCapital, 2, '.', '');
          $obj->initialbalance = number_format($initialbalance, 2, '.', '');
          $obj->interestAmount = number_format($interesMensual, 2, '.', '');
          array_push($tabla,$obj);
        }
        return $tabla;    
    }

    private function crearTablaInteresPorInversionista($periodo, $tasa, $cuotas,$montosInver, $cantInversionistas, $fecha, $referencia, $diapago, $inversionistas){
        //Calcular variables
        $pagosPorAno = $periodo;
        $tasaPromedio = ($tasa / $pagosPorAno);

        //Calcular tabla amortizable por inversionista
        $tablaGeneral = new \stdClass;
        $fechaAc = new \DateTime($fecha);

        for ($j = 0; $j < $cantInversionistas; $j++) {
            $monto2 = $montosInver[$j];
            $saldoPendiente2 = $monto2;
            $inversionista = $inversionistas[$j];
            $tabla2 = [];
            for ($k = 0; $k <= $cuotas; $k++) {
              $fecha2 = clone $fechaAc;
              $fecha2->modify('+' . ($k + 1) . ' month');
              $interesMensual3 = $saldoPendiente2 * $tasaPromedio;
              $amortizacionCapital3 = 0;
                if($k == $cuotas){
                $amortizacionCapital3= $saldoPendiente2;
                }else{
                $amortizacionCapital3 = 0; 
                }
              $saldoPendiente2 = $saldoPendiente2 - $amortizacionCapital3;
              $initialbalance3 = $saldoPendiente2 + $amortizacionCapital3;
              
              $obj2 = new \stdClass;
              $obj2->diapago = $diapago;
              $obj2->referencia = $referencia;
              $obj2->date = $fecha2->format('d-m-Y');
              $obj2->isPaid = false;
              $obj2->balance = number_format($saldoPendiente2, 2, '.', '');
              $obj2->sequence = $k;
              $obj2->toReceive = number_format(($amortizacionCapital3 +  $interesMensual3), 2, '.', '');
              $obj2->capitalAmount = number_format($amortizacionCapital3, 2, '.', '');
              $obj2->initialbalance = number_format($initialbalance3, 2, '.', '');
              $obj2->interestAmount = number_format($interesMensual3, 2, '.', '');
              $obj2->inversionista_id = $inversionista;
              array_push($tabla2,$obj2);
            }
            $key2 = $j + 1;
            $name = 'inv'.$key2;
            $tablaGeneral->$name = $tabla2;
        }
        return $tablaGeneral;
    }

}
