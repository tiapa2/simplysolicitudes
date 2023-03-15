<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $nombre
 * @property $cedula
 * @property $correo
 * @property $created_at
 * @property $updated_at
 *
 * @property Solicitude[] $solicitudes1
 * @property Solicitude[] $solicitudes2
 * @property Solicitude[] $solicitudes3
 * @property Solicitude[] $solicitudes4
 * @property Solicitude[] $solicitudes5
 * @property Solicitude[] $solicitudes6
 * @property Solicitude[] $solicitudes7
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'cedula' => 'required',
		'correo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','cedula','correo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes7()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_7', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes4()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_4', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes1()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_1', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes5()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_5', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes2()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_2', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes6()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_6', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes3()
    {
        return $this->hasMany('App\Models\Solicitude', 'id_inv_3', 'id');
    }
    

}
