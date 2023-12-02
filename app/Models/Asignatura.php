<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Asignatura
 *
 * @property $id
 * @property $nombre
 * @property $objetivo
 * @property $competencia_general
 * @property $competencia_especifica
 * @property $fuentes_informacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Asignacione[] $asignaciones
 * @property Unidade[] $unidades
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Asignatura extends Model
{
    use HasFactory;


    static $rules = [
        'nombre' => 'required',
        'objetivo' => 'required',
        'competencia_general' => 'required',
        'competencia_especifica' => 'required',
        'fuentes_informacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'objetivo',
        'competencia_general',
        'competencia_especifica',
        'fuentes_informacion'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaciones()
    {
        return $this->hasMany(Asignacione::class, 'id_asignatura');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unidades()
    {
        return $this->hasMany(Unidade::class, 'asignatura_id');
    }
}
