<a class="radio-btn btn btn-xs btn-secondary btn-sm " title="Ver Departamentos"
    href="{{ route('admin.departaments.show', $row->id) }}"><i class="fa fa-eye"></i></a>


<a class="radio-btn btn btn-xs btn-primary btn-sm" title="Editar Departamentos"
    href="{{ route('admin.departaments.edit', $row->id) }}"><i class="fa fa-edit"></i></a>

<button class="radio-btn btn btn-sm btn-danger delete_user_form" title="Eliminar Departamentos" id="botonEliminar"
    data-id="{{ $row->id }}" data-name="{{ $row->name }}">
    <i class="btn-action fas fa-trash-alt"></i>
</button>
