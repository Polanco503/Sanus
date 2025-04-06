<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreatmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'paciente') {
            // Ve sólo sus tratamientos
            $treatments = Treatment::where('patient_id', $user->id)->get();
        } elseif ($user->role === 'medico') {
            // Un médico puede ver los de sus pacientes (esto requiere lógica extra,
            // por simplicidad, mostramos todos).
            $treatments = Treatment::all();
        } else {
            // admin ve todos
            $treatments = Treatment::all();
        }

        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        // un médico o un admin podría asignar tratamiento a un paciente
        if (Auth::user()->role === 'paciente') {
            return redirect()->route('treatments.index')
                ->with('error', 'No tienes permiso para asignar tratamientos.');
        }

        // Lista de pacientes para asignar tratamiento
        $patients = User::where('role', 'paciente')->get();
        return view('treatments.create', compact('patients'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'paciente') {
            return redirect()->route('treatments.index')
                ->with('error', 'No tienes permiso para asignar tratamientos.');
        }

        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'nombre_medicamento' => 'required|string',
            'dosis' => 'required|string',
            'frecuencia' => 'required|string'
        ]);

        Treatment::create($request->all());

        return redirect()->route('treatments.index')
            ->with('success', 'Tratamiento asignado con éxito.');
    }

    public function edit(Treatment $treatment)
    {
        // Sólo el médico o admin podría editar
        return view('treatments.edit', compact('treatment'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'nombre_medicamento' => 'required|string',
            'dosis' => 'required|string',
            'frecuencia' => 'required|string'
        ]);

        $treatment->update($request->all());

        return redirect()->route('treatments.index')
            ->with('success', 'Tratamiento actualizado.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatments.index')
            ->with('success', 'Tratamiento eliminado.');
    }
}
