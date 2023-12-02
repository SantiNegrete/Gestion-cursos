<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CriteriosEvaluacion
 *
 * @property $id
 * @property $descripcion
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CriteriosEvaluacion extends Model
{
    protected $table = 'criterios_evaluacion';
    static $rules = [
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion'];



}
