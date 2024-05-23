@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">DETALLE DEL DEPARTAMENTO</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name"
                                    value="{{ $departament->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Descripcion</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" readonly rows="2">{{ $departament->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a type="submit" class="btn btn-secondary" href="{{ route('admin.departaments.index') }}">
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
