<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Asignacione
 *
 * @property $id
 * @property $id_profesor
 * @property $id_asignatura
 *
 * @property Asignatura $asignatura
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Asignacione extends Model
{
    public $timestamps = false;
    
    static $rules = [
        'id_profesor' => 'required',
        'id_asignatura' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_profesor', 'id_asignatura'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asignatura()
    {
        return $this->belongsTo('App\Models\Asignatura', 'id_asignatura');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_profesor');
    }
}
