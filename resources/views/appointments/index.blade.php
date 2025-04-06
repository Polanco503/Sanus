@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Listado de Citas</h1>

    @if (Auth::user()->role === 'paciente')
        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">
            Agendar Cita
        </a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($appointments->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->fecha_cita }}</td>
                    <td>{{ $appointment->estado }}</td>
                    <td>
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}"
                              method="POST"
                              style="display:inline-block;"
                              onsubmit="return confirm('¿Desea eliminar la cita?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No hay citas registradas.</p>
    @endif
</div>
@endsection
