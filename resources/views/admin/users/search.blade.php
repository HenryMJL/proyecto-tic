@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Busqueda</div>

                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('admin.user.search') }}" method="GET">
                                <label>
                                    <input type="radio" name="search_type" value="user" checked> Buscar por Nombre de
                                    Usuario
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="search_type" value="departamento"> Buscar por Dependencia
                                </label>
                                <br>
                                <br>
                                <div id="search_user" style="display: block;">
                                    <input type="text" name="querys" placeholder="Nombre de Usuario">
                                </div>
                                <div id="search_departamento" style="display: none;">
                                    <select name="query">
                                        <option value="">Selecciona una dependencia</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-success" type="submit">Buscar</button>
                                    <a class="btn btn-secondary" href="{{ route('admin.home') }}" type="submit">Volver</a>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="search_type"]').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'user') {
                    $('#search_user').show();
                    $('#search_departamento').hide();
                    $('#search_departamento').prop('disable',true);
                } else {
                    $('#search_user').hide();
                    $('#search_user').prop('disable',true);
                    $('#search_departamento').show();
                }
            });
            $('#search_departamento').hide();
        });
    </script>
@endsection
