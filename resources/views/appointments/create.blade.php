@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Agendar Cita</h1>

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

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Médico:</label>
            <select name="doctor_id" id="doctor_id" class="form-select">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_cita" class="form-label">Fecha y Hora:</label>
            <input type="datetime-local" name="fecha_cita" id="fecha_cita"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Crear</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
