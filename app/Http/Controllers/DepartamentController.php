<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.departaments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departaments.create');
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
            'name' => 'required|string|max:255|unique:departaments,name',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            Departament::create($request->all());
        } catch (\Exception $e) {
            return redirect()->route('admin.departaments.index')->with('error', 'Error al crear el registro');
        }
        return redirect()->route('admin.departaments.index')->with('success', 'Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Departament $departament)
    {
        return view('admin.departaments.show', compact('departament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departament $departament)
    {
        return view('admin.departaments.edit', compact('departament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departament $departament)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departaments,name,' . $departament->id,
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $departament->update($request->all());
        } catch (\Exception $e) {
            return redirect()->route('admin.departaments.index')->with('error', 'Error al crear el registro');
        }
        return redirect()->route('admin.departaments.index')->with('success', 'Registro creado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departament $departament)
    {
        $departament->load('users');
        if ($departament->users->count() > 0) {
            return response()->json(['success' => false]);
        }
        $departament->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Metodo para creacion de tabla usuarios
     *
     * @return void
     */
    public function datatable()
    {
        $departaments = Departament::orderBy('id', 'desc')->get();
        return DataTables::of($departaments)
            ->addColumn('acciones', function ($row) {
                return view('admin.departaments.buttons', compact('row'))->render();
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }
}
