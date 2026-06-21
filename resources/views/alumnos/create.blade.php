@extends('layout')
@section('content')
    <div class="container mt-3">
        <h1>Nuevo alumno</h1>

        <form action="{{ route('alumnos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
                @error('apellidos') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nivel</label>
                <select name="nivel" class="form-select">
                    <option value="basico" {{ old('nivel') == 'basico' ? 'selected' : '' }}>Básico</option>
                    <option value="intermedio" {{ old('nivel') == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                    <option value="avanzado" {{ old('nivel') == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                </select>
                @error('nivel') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="es_becado" id="es_becado" {{ old('es_becado') ? 'checked' : '' }}>
                <label class="form-check-label" for="es_becado">Es becado</label>
            </div>

            <button class="btn btn-success">Crear</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
@endsection