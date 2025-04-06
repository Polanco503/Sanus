@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Editar Tratamiento #{{ $treatment->id }}</h1>

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

    <form action="{{ route('treatments.update', $treatment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre_medicamento" class="form-label">Medicamento:</label>
            <input type="text" name="nombre_medicamento" id="nombre_medicamento"
                   class="form-control" value="{{ $treatment->nombre_medicamento }}" required>
        </div>

        <div class="mb-3">
            <label for="dosis" class="form-label">Dosis:</label>
            <input type="text" name="dosis" id="dosis"
                   class="form-control" value="{{ $treatment->dosis }}" required>
        </div>

        <div class="mb-3">
            <label for="frecuencia" class="form-label">Frecuencia:</label>
            <input type="text" name="frecuencia" id="frecuencia"
                   class="form-control" value="{{ $treatment->frecuencia }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
