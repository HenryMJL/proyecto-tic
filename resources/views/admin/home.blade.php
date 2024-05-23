@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul>
                            <li><a href="{{ route('admin.users.index') }}"> Ver Usuarios </a></li>
                            <li><a href="{{ route('admin.departaments.index') }}"> Ver Departamentos </a></li>
                            <br>
                            <li><a href="{{ route('admin.profile', ['user' => auth()->user()]) }}">Mi Perfil</a></li>
                            <br>
                            <li><a href="{{ route('admin.form.search') }}">Consultar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
