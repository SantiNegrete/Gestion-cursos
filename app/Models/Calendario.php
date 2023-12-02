<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * Class Calendario
 *
 * @property $id
 * @property $nombre_semana
 * @property $fecha_inicio
 * @property $fecha_fin
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Calendario extends Model
{
    protected $table = 'calendario';
    use HasFactory;
    
    static $rules = [
        'nombre_semana' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_semana', 'fecha_inicio', 'fecha_fin'];

    /**
     * Get the formatted date as per the user's request.
     *
     * @return string
     */
    protected function getFechaFormateada()
    {
        $meses = [
            '01' => 'Ene.',
            '02' => 'Feb.',
            '03' => 'Mar.',
            '04' => 'Abr.',
            '05' => 'May.',
            '06' => 'Jun.',
            '07' => 'Jul.',
            '08' => 'Ago.',
            '09' => 'Sep.',
            '10' => 'Oct.',
            '11' => 'Nov.',
            '12' => 'Dic.'
        ];

        $inicio = Carbon::parse($this->fecha_inicio);
        $fin = Carbon::parse($this->fecha_fin);

        return $this->nombre_semana . " (" . $inicio->day . " " . $meses[$inicio->format('m')] . " - " . $fin->day . " " . $meses[$fin->format('m')] . ")";
    }

    /**
     * Accessor for formatted date.
     *
     * @return string
     */
    public function getNombreCompletoAttribute()
    {
        return $this->getFechaFormateada();
    }
}
