<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tema
 *
 * @property $id
 * @property $id_unidad
 * @property $nombre
 * @property $practica_id
 * @property $calendario_id     
 * @property $instrumentacion_id 
 * @property $created_at
 * @property $updated_at
 * @property Subtema[] $subtemas
 * @property Unidade $unidade
 * @property Calendario $calendario    
 * @property Instrumentacion $instrumentacion 
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tema extends Model
{
    use HasFactory;
    
    static $rules = [
        'id_unidad' => 'required',
        'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_unidad','nombre','practica_id','calendario_id','instrumentacion_id']; // añadidas nuevas columnas


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade', 'id', 'id_unidad');
    }

    public function practica()
    {
        return $this->hasOne('App\Models\Practica', 'id', 'practica_id');
    }
    
    public function calendario()
    {
        return $this->belongsTo('App\Models\Calendario', 'calendario_id', 'id');
    }

    
    public function instrumentacion()
    {
        return $this->belongsTo('App\Models\Instrumentacion', 'instrumentacion_id', 'id');
    }
}

