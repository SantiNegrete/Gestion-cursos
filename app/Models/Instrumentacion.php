<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Instrumentacion
 *
 * @property $id
 * @property $tipo_instrumentacion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Instrumentacion extends Model
{
    protected $table = 'instrumentacion';
    use HasFactory;
    static $rules = [
		'tipo_instrumentacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_instrumentacion'];



}
