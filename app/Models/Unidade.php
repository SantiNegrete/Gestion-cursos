<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Unidade
 *
 * @property $id
 * @property $asignatura_id
 * @property $nombre
*  @property $objetivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Asignatura $asignatura
 * @property Calendario[] $calendarios
 * @property Tema[] $temas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Unidade extends Model
{
    use HasFactory;
       
    static $rules = [
		'asignatura_id' => 'required',
		'nombre' => 'required',
        'objetivo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['asignatura_id','nombre', 'objetivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function asignatura()
    {
        return $this->hasOne('App\Models\Asignatura', 'id', 'asignatura_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calendarios()
    {
        return $this->hasMany('App\Models\Calendario', 'id_unidad', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temas()
    {
        return $this->hasMany(Tema::class, 'id_unidad');
        return $this->hasMany('App\Models\Tema', 'id_unidad', 'id');
    }
    public function configuracionesDocentes()
    {
        return $this->hasMany(ConfiguracionDocente::class, 'unidad_id');
    }
    

}
