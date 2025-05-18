<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProveedorController extends Controller
{
    // Mostrar lista de proveedores
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productos = Proveedor::get(); // Cargar la relación subCategoria

            return DataTables::of($productos)

                ->addColumn('actions', 'proveedores.actions')
                ->editColumn('estado', function ($row) {
                    return $row->estado == '1'
                        ? '<span class="badge bg-blue-lt">Activo</span>'
                        : '<span class="badge bg-red-lt">Inactivo</span>';
                })

                ->rawColumns(['actions', 'estado'])
                ->make(true);
        } else {

            return view('proveedores.index');
        }
    }

    // Mostrar formulario para crear proveedor
    public function create()
    {
        return view('proveedores.create');
    }

    // Guardar nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'rif' => 'required|string|max:20|unique:proveedores,rif',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'estado' => 'required',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente.');
    }

    // Mostrar formulario para editar proveedor
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    // Actualizar proveedor
    public function update(Request $request, $id)
    {
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'rif' => "required|string|max:20|unique:proveedores,rif,{$id}",
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'estado' => 'required',
        ]);
        $proveedor = Proveedor::find($id);
        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    // Eliminar proveedor
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
