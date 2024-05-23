@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">CREAR USUARIO</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="name" placeholder="Por favor digita tu Nombre ... "
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="departament_id" class="col-md-4 col-form-label text-md-end">Departamento</label>
                                <div class="col-md-6">
                                    <select id="departament_id" name="departament_id"
                                        class="form-control @error('departament_id') is-invalid @enderror" required
                                        autofocus>
                                        <option value="">Seleccione un Departamento</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('departament_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electronico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="Por favor digita tu Email ... "
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="Por favor digita tu Contraseña ..."
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Registrar Usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">REQUISITOS PARA LA CONTRASEÑA </div>
                    <div class="card-body">
                        <ul>
                            <li>Debe contener al menos 8 caracteres.</li>
                            <li>Debe contener al menos 1 letra mayúscula.</li>
                            <li>Debe contener al menos 1 letra minúscula.</li>
                            <li>Debe contener al menos 1 número.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
