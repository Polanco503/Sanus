<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'patient_id', 'nombre_medicamento', 'dosis', 'frecuencia'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
