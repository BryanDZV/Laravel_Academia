@extends('layout')
@section('content')
    @auth
        @if(auth()->user()->rol === 'admin')
            <a href="{{ route('alumnos.create') }}" class="btn btn-primary mb-2">Nuevo alumno</a>
        @endif
    @endauth
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>EMAIL</th>
                    <th>NIVEL</th>
                    <th>BECADO</th>

                    <th class="text-end">
                        {{-- Lógica según el rol del usuario --}}
                        @if(Auth::user()->rol === 'admin')
                            <a href="#" class="btn btn-sm btn-primary">Acción</a>
                        @elseif(Auth::user()->rol === 'profesor')

                        @endif
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellidos}}</td>
                        <td>{{ $alumno->email }}</td>
                        <td>{{ $alumno->nivel }}</td>
                        <td>{{ $alumno->es_becado ? 'Sí' : 'No' }}</td>
                        <td class="text-end">
                            @auth
                                @if(auth()->user()->rol === 'admin')
                                    <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar?')">Borrar</button>
                                    </form>
                                @endif
                            @endauth
                        </td>



                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            {{ $alumnos->links() }}
        </div>
    </div>

@endsection