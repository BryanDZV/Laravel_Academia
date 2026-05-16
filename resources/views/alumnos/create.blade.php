@extends('layout')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Crear Registro</div>
        <div class="card-body">
            {{-- el create manda al store, el edit manda al update --}}
            <form action="{{ route('alumnos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $item->nombre ?? '') }}" required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror"
                        value="{{ old('apellidos', $item->apellidos ?? '') }}" required>
                    @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $item->email ?? '') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nivel</label>
                    <select name="nivel" class="form-select @error('nivel') is-invalid @enderror">
                        <option value="">Selecciona opcion</option>
                        <option value="basico" {{ old('nivel', $alumno->nivel ?? '') == 'basico' ? 'selected' : '' }}>
                            Básico
                        </option>
                        <option value="intermedio" {{ old('nivel', $alumno->nivel ?? '') == 'intermedio' ? 'selected' : '' }}>
                            Intermedio
                        </option>
                        <option value="avanzado" {{ old('nivel', $alumno->nivel ?? '') == 'avanzado' ? 'selected' : '' }}>
                            Avanzado
                        </option>
                    </select>
                    @error('nivel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-check">

                    <input class="form-check-input" type="checkbox" value="1" id="becado" name="es_becado" {{ old('es_becado') ? 'checked' : '' }} />
                    <label class="form-check-label" for="becado"> Becado </label>
                </div>





                <div class="mt-4">
                    {{-- si cancela regresa a la lista de alumnos, si guarda manda el formulario al store --}}
                    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
                    {{-- el botón de guardar envía el formulario al método store del controlador --}}
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection