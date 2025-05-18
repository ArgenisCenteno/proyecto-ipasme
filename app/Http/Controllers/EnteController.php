<?php

namespace App\Http\Controllers;

use App\Models\Ente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;
class EnteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productos = Ente::get(); // Cargar la relación subCategoria

            return DataTables::of($productos)

                ->addColumn('actions', 'entes.actions')
                ->editColumn('estado', function ($row) {
                    return $row->estado == '1'
                        ? '<span class="badge bg-blue-lt">Activo</span>'
                        : '<span class="badge bg-red-lt">Inactivo</span>';
                })

                ->rawColumns(['actions', 'estado'])
                ->make(true);
        } else {

            return view('entes.index');
        }
    }

    public function create()
    {
        return view('entes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'rif' => 'required|string|max:20|unique:entes,rif',
            'encargado' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255',
            'estado' => 'required|in:1,0',
        ]);

        Ente::create($request->all());
        Alert::success('Éxito!', 'Ente Registrado')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('entes.index')->with('success', 'Ente registrado correctamente.');
    }

    public function edit(Ente $ente)
    {
        // Retorna la vista de edición con los datos del ente
        return view('entes.edit', compact('ente'));
    }


    public function update(Request $request, Ente $ente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'rif' => 'required|string|max:20|unique:entes,rif,' . $ente->id,
            'encargado' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255',
            'estado' => 'required|in:1,0',
        ]);

        $ente->update($request->all());
        Alert::success('Éxito!', 'Ente Actualizado')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('entes.index')->with('success', 'Ente actualizado correctamente.');
    }

    public function destroy(Ente $ente)
    {
        $ente->delete();
        Alert::success('Éxito!', 'Ente Eliminado')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('entes.index')->with('success', 'Ente eliminado correctamente.');
    }
}
