@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Acceso</h2>

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="login" class="form-control" value="{{ old('login') }}" required
                                    autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
                        </form>

                        @if($errors->has('login'))
                            <div class="alert alert-danger mt-3 small text-center">
                                {{ $errors->first('login') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection