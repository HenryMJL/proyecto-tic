@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">EDITAR PERFIL</div>

                    <div class="card-body">
                        <form method="POST" id="profileForm" action="{{ route('admin.profile.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab"
                                        data-bs-target="#info-datos-personales" type="button" role="tab"
                                        aria-controls="info-datos-personales" aria-selected="true">Mis Datos
                                        Personales</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="history-tab" data-bs-toggle="tab"
                                        data-bs-target="#info-contraseña" type="button" role="tab"
                                        aria-controls="info-contraseña" aria-selected="false">Contraseña</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="info-datos-personales" role="tabpanel"
                                    aria-labelledby="info-tab" data-tabname="Datos Personales">
                                    <div class="container">
                                        <br>
                                        <div class="row">
                                            <div class="row mb-3">
                                                <label for="name"
                                                    class="col-md-4 col-form-label text-md-end">Nombre</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="name"
                                                        placeholder="Por favor digita tu Nombre ... "
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ $user->name }}" required
                                                        autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">Correo
                                                    Electronico</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email"
                                                        placeholder="Por favor digita tu Email ... "
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ $user->email }}" required
                                                        autocomplete="email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="info-contraseña" role="tabpanel" aria-labelledby="info-tab"
                                    data-tabname="Contraseña">
                                    <br>
                                    <div class="row">
                                        <div class="container">
                                            <div class="row mb-3">
                                                <label for="password_old"
                                                    class="col-md-4 col-form-label text-md-end">Contraseña Actual</label>

                                                <div class="col-md-6">
                                                    <input id="password_old" type="password_old"
                                                        placeholder="Por favor digita tu Contraseña Actual ..."
                                                        class="form-control @error('password_old') is-invalid @enderror"
                                                        name="password_old">

                                                    @error('password_old')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-end">Contraseña Nueva</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                        placeholder="Por favor digita tu Contraseña Nueva ..."
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success" id="openModalButton">
                                        Actualizar Perfil
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="requisitos-contraseña" class="col-md-3" style="display: none;">
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

    <div class="modal" id="password_oldModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Datos</h5>
                </div>
                <div class="modal-body">
                    <form id="password_oldForm">
                        <div class="form-group">
                            <label for="password_oldInput">Contraseña Actual</label>
                            <input type="password_old" class="form-control" id="password_oldInput"
                                placeholder="Ingrese su contraseña">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmPassword_oldButton">Confirmar</button>
                    <button type="button" class="btn btn-secondary" id="cancelButton"
                        data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function mostrarRequisitosContraseña() {
                $('#requisitos-contraseña').css('display', 'block');
            }

            function ocultarRequisitosContraseña() {
                $('#requisitos-contraseña').css('display', 'none');
            }

            $('#history-tab').click(mostrarRequisitosContraseña);
            $('#info-tab').click(ocultarRequisitosContraseña);

            $('#openModalButton').click(function(event) {
                event.preventDefault();
                $('#password_oldModal').modal('show');
            });

            $('#confirmPassword_oldButton').click(function() {
                var password_old = $('#password_oldInput').val();
                $('#password_old').val(password_old);
                $('#profileForm').submit();
            });

            $('#cancelButton').click(function() {
                $('#password_oldModal').modal('hide');
                $('#password_oldInput').val('');
                $('#password_old').val('');
            });
        });
    </script>
@endsection
