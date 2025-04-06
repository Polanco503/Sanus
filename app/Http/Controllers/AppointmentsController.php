<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function __construct()
    {
        // Requiere autenticación para todas las acciones
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'paciente') {
            $appointments = Appointment::where('patient_id', $user->id)->get();
        } elseif ($user->role === 'medico') {
            $appointments = Appointment::where('doctor_id', $user->id)->get();
        } else {
            // Si es admin, ve todas las citas
            $appointments = Appointment::all();
        }

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        // Sólo pacientes pueden crear citas
        // Si quieres que admin también pueda crearlas para algún paciente, cambia la lógica
        if (Auth::user()->role !== 'paciente') {
            return redirect()->route('appointments.index')
                ->with('error', 'No tienes permiso para agendar citas.');
        }

        $doctors = User::where('role', 'medico')->get();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'fecha_cita' => 'required|date'
        ]);

        // Crea la cita
        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'fecha_cita' => $request->fecha_cita,
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Cita agendada con éxito.');
    }

    public function edit(Appointment $appointment)
    {
        // Podrías permitir que admin o el paciente/doctor involucrado editen
        return view('appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Actualiza estado, etc.
        $request->validate([
            'estado' => 'required|in:pendiente,realizada,cancelada'
        ]);

        $appointment->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Cita actualizada.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')
            ->with('success', 'Cita eliminada.');
    }
}
