<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ejemplo: conteo de pacientes por enfermedad crónica
        // (requieres un campo en la tabla users para almacenar su enfermedad, 
        // o una tabla aparte. A modo de ejemplo, haz un groupBy de 'sexo'):

        $pacientesPorSexo = DB::table('users')
            ->select('sexo', DB::raw('count(*) as total'))
            ->where('role', 'paciente')
            ->groupBy('sexo')
            ->get();

        return view('reports.index', compact('pacientesPorSexo'));
    }
}
