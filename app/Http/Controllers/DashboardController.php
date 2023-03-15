<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Solicitude;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Buscar la fecha actual
        $month = new \DateTime();
        //Llamar todas las solicitudes
        $array = $this->obtenerCuotasGenerles($month);
        $array2 = $this->obtenerCuotasPorInversinista($month);
        
        $clientes = Cliente::get();
        $clientes = json_decode($clientes);

        return view('dashboard.index', compact('array','array2','clientes'));
    }

    public function pdf(Request $request){
        $month = new \DateTime($request->month);

        $array = $this->obtenerCuotasGenerles($month);

        //return view('dashboard.pdf', compact('array', 'month'));
        $pdf = Pdf::loadView('dashboard.pdf', compact('array','month'));
        return $pdf->stream();
    }

    public function pdf2(Request $request){
        $month2 = new \DateTime($request->month2);
        $array = $this->obtenerCuotasGenerles($month2);
        $array2 = $this->obtenerCuotasPorInversinista($month2);
        $clientes = Cliente::get();
        $clientes = json_decode($clientes);

        //return view('dashboard.pdf2', compact('array','array2', 'month2', 'clientes'));
        $pdf = Pdf::loadView('dashboard.pdf2', compact('array','array2','month2','clientes'));
        return $pdf->stream();
    }

    public function obtenerCuotasGenerles($date){
        $solicitudes = Solicitude::get();
        $sols = json_decode($solicitudes);
        $array = [];
        //Sacar la tabla de amortización de cada solicitud
        foreach ($sols as $sol) {
            //Tabla de amortización de una solicitud
            $tabla = json_decode($sol->tabla_amortizacion);
            $array2 = [];
            foreach ($tabla as $tab){
                //Aquí recorro la tabla de amortización por cada parámetro del objeto
                if(date('m-Y', strtotime($tab->date)) == $date->format('m-Y')){
                    array_push($array2, $tab);
                }
            }
            //El array2 contiene cada secuencia de la tabla 
            if($array2 != null){
                array_push($array, $array2);
            }
        }
        return $array;
    }

    public function obtenerCuotasPorInversinista($date){
        $sols = Solicitude::get('tabla_inversionistas');

        $solicitudes = json_decode($sols);
        $array = [];
        foreach ($solicitudes as $solicitud) {
            $sol = $solicitud->tabla_inversionistas;
            $inversionistas = json_decode($sol);
            $array2 = [];
                foreach ($inversionistas as $inversionista) {
                    $array3 = [];
                    foreach($inversionista as $secuencia){ 
                        if (date('m-Y', strtotime($secuencia->date)) == $date->format('m-Y')) {
                            array_push($array3, $secuencia);
                        }
                    }
                    if($array3 != null){
                        array_push($array2, $array3);
                    }
                }
            if($array2 != null){
                array_push($array, $array2);
            }
        }
        return $array;
    }
}
