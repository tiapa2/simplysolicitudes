<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitude
 *
 * @property $id
 * @property $moneda
 * @property $monto
 * @property $int_anual
 * @property $int_comision
 * @property $cuotas
 * @property $periodo
 * @property $fecha_inicial
 * @property $fecha_final
 * @property $modalidad
 * @property $cant_inversionistas
 * @property $estado
 * @property $referencia
 * @property $diapago
 * @property $tabla_inversionistas
 * @property $tabla_amortizacion
 * @property $id_inv_1
 * @property $monto_inv_1
 * @property $id_inv_2
 * @property $monto_inv_2
 * @property $id_inv_3
 * @property $monto_inv_3
 * @property $id_inv_4
 * @property $monto_inv_4
 * @property $id_inv_5
 * @property $monto_inv_5
 * @property $id_inv_6
 * @property $monto_inv_6
 * @property $id_inv_7
 * @property $monto_inv_7
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente1
 * @property Cliente $cliente2
 * @property Cliente $cliente3
 * @property Cliente $cliente4
 * @property Cliente $cliente5
 * @property Cliente $cliente6
 * @property Cliente $cliente7
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Solicitude extends Model
{
    
    static $rules = [
		'moneda' => 'required',
		'monto' => 'required',
		'int_anual' => 'required',
		'int_comision' => 'required',
		'cuotas' => 'required',
		'periodo' => 'required',
		'fecha_inicial' => 'required',
		'fecha_final' => 'required',
		'modalidad' => 'required',
		'cant_inversionistas' => 'required',
		'estado' => 'required',
		'referencia' => 'required',
        'diapago' => 'required',
		'id_inv_1' => 'required',
        'monto_inv_1' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['moneda','monto','int_anual','int_comision','cuotas','periodo','fecha_inicial','fecha_final','modalidad','cant_inversionistas','estado','referencia','diapago','tabla_inversionistas', 'tabla_amortizacion','id_inv_1','monto_inv_1','id_inv_2','monto_inv_2','id_inv_3','monto_inv_3','id_inv_4','monto_inv_4','id_inv_5','monto_inv_5','id_inv_6','monto_inv_6','id_inv_7','monto_inv_7'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente7()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_7');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente4()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_4');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente1()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_1');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente5()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_5');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente2()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_2');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente6()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_6');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente3()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'id_inv_3');
    }
    

}
