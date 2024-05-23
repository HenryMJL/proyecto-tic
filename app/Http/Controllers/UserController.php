<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departament::all();
        return view('admin.users.create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'departament_id' => 'required',
            'email' => 'required|unique:users,email',
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $request['password'] = Hash::make($request->password);
            User::create($request->all());
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Error al crear el registro');
        }
        return redirect()->route('admin.users.index')->with('success', 'Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $departamentos = Departament::all();
        return view('admin.users.edit', compact('user', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'departament_id' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->update($request->all());
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Error al actualizar el registro');
        }
        return redirect()->route('admin.users.index')->with('success', 'Registro actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Metodo para creacion de tabla usuarios
     *
     * @return void
     */
    public function datatable()
    {
        $users = User::with('departament')
            ->orderBy('id', 'desc')
            ->get();
        return DataTables::of($users)
            ->editColumn('departament_id', function ($row) {
                return $row->departament->name ?? 'Sin Asignar';
            })
            ->addColumn('acciones', function ($row) {
                return view('admin.users.buttons', compact('row'))->render();
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    /**
     * Metodo para dirigirnos a la administracion de mi perfil.
     *
     * @param User $user
     * @return void
     */
    public function myProfile(User $user)
    {
        return view('admin.users.profile', compact('user'));
    }

    /**
     * Metodo para persistencia de datos del perfil.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function myProfileUpdate(Request $request, User $user)
    {
        if (Hash::check($request->password_old, $user->password)) {
            if ($request->password != null) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|unique:users,email,' . $user->id,
                    'password' => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                ]);
            } else {
                unset($request['password']);
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|unique:users,email,' . $user->id,
                ]);
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            try {
                $user->update($request->all());
            } catch (\Exception $e) {
                return redirect()->route('admin.users.index')->with('error', 'Error al actualizar el registro');
            }
            return redirect()->route('admin.users.index')->with('success', 'Registro actualizado con éxito');
        }
        return back()->withInput()->with('error', 'La contraseña actual es incorrecta');
    }

    public function formSearch()
    {
        $departamentos = Departament::all();
        return view('admin.users.search', compact('departamentos'));
    }

    /**
     * Metodo para realizar la consulta
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {

        $type = $request->input('search_type');
        // $query = $request->input('query');

        // Realizar la búsqueda de acuerdo al tipo seleccionado
        if ($type === 'user') {
            $query=$request->input('querys');
            $usersQuery = User::where('name', 'like', "%$query%");
        } else {
            $query=$request->input('query');
            $usersQuery = User::where('departament_id', $query);
        }

        // Obtener los usuarios paginados
        $perPage = 5; // Número de elementos por página
        $users = $usersQuery->paginate($perPage)->appends(['search_type' => $type, 'query' => $query]);

        return view('admin.users.paginado', compact('users'));
    }
}
