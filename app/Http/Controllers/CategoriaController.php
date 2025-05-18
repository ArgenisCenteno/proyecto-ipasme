<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;
class CategoriaController extends Controller
{
    // Mostrar todas las categorías
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $productos = Categoria::get(); // Cargar la relación subCategoria

            return DataTables::of($productos)

                ->addColumn('actions', 'categorias.actions')
                ->editColumn('estado', function ($row) {
                    return $row->estado == '1'
                        ? '<span class="badge bg-blue-lt">Activo</span>'
                        : '<span class="badge bg-red-lt">Inactivo</span>';
                })

                ->rawColumns(['actions', 'estado'])
                ->make(true);
        } else {

            return view('categorias.index');
        }
    }

    // Mostrar el formulario para crear una nueva categoría
    public function create()
    {
        return view('categorias.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    // Mostrar el formulario para editar una categoría existente
    public function edit(Categoria $categoria)
    {
       
        return view('categorias.edit', compact('categoria'));
    }
 
    // Actualizar una categoría existente
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar una categoría
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
