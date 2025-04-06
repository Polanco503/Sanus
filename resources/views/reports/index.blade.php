@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Reportes y Estadísticas</h1>

    @if($pacientesPorSexo ?? null)
        <h4>Pacientes por Sexo</h4>
        <table class="table table-bordered mb-4">
            <thead>
            <tr>
                <th>Sexo</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pacientesPorSexo as $item)
                <tr>
                    <td>{{ $item->sexo }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No hay datos para mostrar.</p>
    @endif

    <!-- Puedes agregar otros reportes aquí -->
</div>
@endsection
