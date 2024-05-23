@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">DETALLE DEL USUARIO</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name"
                                    value="{{ $user->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="departament_id" class="col-md-4 col-form-label text-md-end">Departamento</label>
                            <div class="col-md-6">
                                <input type="text" name="departament_id" class="form-control"
                                    value="{{ $user->departament->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"
                                    name="email"value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a type="submit" class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
