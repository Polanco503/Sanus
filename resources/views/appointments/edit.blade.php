@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Cita #{{ $appointment->id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong>
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select">
                <option value="pendiente" {{ $appointment->estado === 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>
                <option value="realizada" {{ $appointment->estado === 'realizada' ? 'selected' : '' }}>
                    Realizada
                </option>
                <option value="cancelada" {{ $appointment->estado === 'cancelada' ? 'selected' : '' }}>
                    Cancelada
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
