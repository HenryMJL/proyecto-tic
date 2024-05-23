@extends('layouts.app')

@section('sytle')
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .card-header div:first-child {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .card-header button {
            padding: 5px 10px;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .card-header button:hover {
            background-color: #0056b3;
        }

        .radio-btn {
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            BASE DE DATOS USUARIOS
                        </div>
                        <div>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear Usuario</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div style="overflow-x:auto;" class="container-fluid">
                            <table class="table dataTable table-bordered table-striped table-hover"
                                style="width: 100%;!important;" id="table-users">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Departemanto</th>
                                        <th class="all">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.home') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on("click", "#botonEliminar i", function() {
            var userid = $(this).closest("#botonEliminar").data("id");
            var name = $(this).closest("#botonEliminar").data("name");
            var table = $('#table-users').DataTable();
            var button = $(this);
            var row = button.closest('tr');
            var currentPage = table.page();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el Usuario: " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value == true) {
                    axios.delete(
                            '{{ route('admin.users.destroy', ['user' => 'userid']) }}'
                            .replace('userid', userid), {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                        .then(response => {
                            Swal.fire(
                                '¡Eliminado!',
                                'El registro se eliminó con éxito',
                                'success'
                            );
                            setTimeout(function() {
                                Swal.close();
                            }, 2000);
                            table.row(row).remove().draw(false);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    console.log("La acción de eliminación se canceló.");
                }
            });
        });

        $(document).ready(function() {
            $('#table-users').DataTable({
                "dom": '<"top"fl>rt<"bottom"ip><"clear">',
                ajax: {
                    url: "{{ route('admin.user.datatable') }}",
                    type: 'GET',
                    dataType: 'json',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'departament_id',
                        name: 'departament_id'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        className: 'text-center'
                    }
                ],
                "language": {
                    "sEmptyTable": "No hay datos disponibles en la tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sLoadingRecords": "Cargando...",
                    "sProcessing": "Procesando...",
                    "sSearch": "Buscar:",
                    "sZeroRecords": "No se encontraron registros coincidentes",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,
            });
        });
    </script>
@endsection
