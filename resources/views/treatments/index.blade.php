@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Listado de Tratamientos</h1>

    @if(Auth::user()->role === 'medico' || Auth::user()->role === 'admin')
        <a href="{{ route('treatments.create') }}" class="btn btn-primary mb-3">
            Asignar Tratamiento
        </a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($treatments->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Medicamento</th>
                <th>Dosis</th>
                <th>Frecuencia</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($treatments as $treatment)
                <tr>
                    <td>{{ $treatment->id }}</td>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->nombre_medicamento }}</td>
                    <td>{{ $treatment->dosis }}</td>
                    <td>{{ $treatment->frecuencia }}</td>
                    <td>
                        @if(Auth::user()->role === 'medico' || Auth::user()->role === 'admin')
                            <a href="{{ route('treatments.edit', $treatment->id) }}"
                               class="btn btn-warning btn-sm">
                               Editar
                            </a>
                            <form action="{{ route('treatments.destroy', $treatment->id) }}"
                                  method="POST"
                                  style="display:inline-block;"
                                  onsubmit="return confirm('¿Desea eliminar este tratamiento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No hay tratamientos registrados.</p>
    @endif
</div>
@endsection
