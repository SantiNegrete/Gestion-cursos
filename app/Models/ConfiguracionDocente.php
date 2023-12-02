<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionDocente extends Model
{
    use HasFactory;

    
    protected $table = 'configuracion_docentes';

   
    protected $fillable = [
        'docente_id',
        'asignatura_id',
        'tema_id',
        'calendario_id',
        'instrumentacion_id',
        'unidad_id', 
    ];
    

    
    public function docente()
    {
        return $this->belongsTo(Usuario::class, 'docente_id');
    }

    public function unidad()
{
    return $this->belongsTo(Unidade::class, 'unidad_id');
}

    
    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }

    
    public function calendario()
    {
        return $this->belongsTo(Calendario::class, 'calendario_id');
    }

    
    public function instrumentacion()
    {
        return $this->belongsTo(Instrumentacion::class, 'instrumentacion_id');
    }
}
