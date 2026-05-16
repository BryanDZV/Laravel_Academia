@extends('layout')
@section('content')
    <div class="container py-4">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Editar Alumno</div>
            <div class="card-body">
                {{-- el edit manda al update, el update recibe el request y el alumno a editar, valida los datos, actualiza
                el alumno y redirige a la vista de la lista de alumnos --}}
                <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $alumno->nombre ?? '') }}" required>
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror"
                            value="{{ old('apellidos', $alumno->apellidos ?? '') }}" required>
                        @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $alumno->email ?? '') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nivel</label>
                        <select name="nivel" class="form-select @error('nivel') is-invalid @enderror">
                            <option value="">Selecciona opcion</option>
                            <option value="basico" {{ old('nivel', $alumno->nivel ?? '') == 'basico' ? 'selected' : '' }}>
                                Básico
                            </option>
                            <option value="intermedio" {{ old('nivel', $alumno->nivel ?? '') == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                            <option value="avanzado" {{ old('nivel', $alumno->nivel ?? '') == 'avanzado' ? 'selected' : '' }}>
                                Avanzado</option>
                        </select>
                        @error('nivel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="becado" name="es_becado" {{ old('es_becado', $alumno->es_becado ?? '') ? 'checked' : '' }} />
                        <label class="form-check-label" for="becado"> Becado </label>
                    </div>





                    <div class="mt-4">
                        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection