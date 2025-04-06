@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Asignar Tratamiento</h1>

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

    <form action="{{ route('treatments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="patient_id" class="form-label">Paciente:</label>
            <select name="patient_id" id="patient_id" class="form-select">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nombre_medicamento" class="form-label">Medicamento:</label>
            <input type="text" name="nombre_medicamento" id="nombre_medicamento"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="dosis" class="form-label">Dosis:</label>
            <input type="text" name="dosis" id="dosis" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="frecuencia" class="form-label">Frecuencia:</label>
            <input type="text" name="frecuencia" id="frecuencia"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
