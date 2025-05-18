<?php

namespace App\Http\Controllers;

use App\Exports\BienesPorDepartamentoExport;
use App\Models\Bien;
use App\Models\BienAsignado;
use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Ente;
use App\Models\HistorialMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Alert;
class BienController extends Controller
{
    // Mostrar todos los bienes
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productos = Bien::with('categoria')->get(); // Cargar la relación subCategoria

            return DataTables::of($productos)
                ->editColumn('estado', function ($row) {
                    return $row->estado == 'Activo'
                        ? '<span class="badge bg-blue-lt">Activo</span>'
                        : '<span class="badge bg-red-lt">Inactivo</span>';
                })
                ->addColumn('actions', 'bienes.actions')


                ->rawColumns(['actions', 'estado'])
                ->make(true);
        } else {

            return view('bienes.index');
        }
    }

    // Formulario para crear un nuevo bien
    public function create()
    {
        $categorias = Categoria::all();
        $departamentos = Departamento::all();
        return view('bienes.create', compact('categorias', 'departamentos'));
    }

    // Almacenar un nuevo bien en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',

            'estado' => 'required|in:Activo,Inactivo,Dañado,Mantenimiento,Desaparecido',


        ]);

        // Generate a unique inventory code
        $codigo_inventario = 'INV-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 6)) . '-' . time();

        // Create the record with the generated codigo_inventario
        Bien::create(array_merge($request->all(), ['codigo_inventario' => $codigo_inventario]));
        Alert::success('¡Exito!', 'Bien registrado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('bienes.index')->with('success', 'Bien registrado exitosamente.');
    }


    // Formulario para editar un bien
    public function edit($id)
    {

        $bien = Bien::find($id);
        $categorias = Categoria::all();
        $departamentos = Departamento::all();
        return view('bienes.edit', compact('bien', 'categorias', 'departamentos'));
    }

    // Actualizar un bien existente
    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',

            'categoria_id' => 'required|exists:categorias,id',

            'estado' => 'required|in:Activo,Inactivo,Dañado,Mantenimiento,Desaparecido',


        ]);

        $bien->update($request->all());
        Alert::success('¡Exito!', 'Bien actualizado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('bienes.index')->with('success', 'Bien actualizado exitosamente.');
    }

    // Eliminar un bien
    public function destroy($id)
    {
        $bien = Bien::find($id);
        $bien->delete();

        return redirect()->route('bienes.index')->with('success', 'Bien eliminado exitosamente.');
    }

    public function bienesActivos(Request $request)
    {
        if ($request->ajax()) {
            $productos = Bien::with('categoria')->where('estado', 'Activo')->get(); // Cargar la relación subCategoria

            return DataTables::of($productos)

                ->make(true);
        }
    }

    public function bienesDisponibles(Request $request)
    {
        $departamento_id = $request->input('departamento_origen_id');

        $query = BienAsignado::with('bien') // Asegúrate de tener la relación 'categoria' en el modelo Bien
            ->where('departamento_id', $departamento_id)
            ->where('estado', 'Activo');

        return DataTables::of($query)
            ->addColumn('categoria_nombre', function ($bien) {
                return $bien->bien->categoria->nombre ?? 'Sin categoría';
            })

            ->addColumn('action', function ($bien) {
                return '<button class="btn btn-sm btn-primary agregar-producto"
                        data-id="' . $bien->id . '" 
                        data-nombre="' . $bien->bien->nombre . '" 
                        data-codigo="' . $bien->codigo_inventario . '" 
                        data-categoria="' . $bien->bien->categoria->nombre . '" 
                        data-unidad="' . $bien->bien->unidad_medida . '">
                        Agregar
                    </button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function inventario(Request $request)
    {
        if ($request->ajax()) {
            $productos = BienAsignado::with('bien')->where('estado', '!=', 'Inactivo')->get(); // Cargar la relación subCategoria

            return DataTables::of($productos)
                ->editColumn('estado', function ($row) {
                    switch ($row->estado) {
                        case 'Activo':
                            return '<span class="badge bg-blue-lt">Activo</span>';
                        case 'Inactivo':
                            return '<span class="badge bg-red-lt">Inactivo</span>';
                        case 'Dañado':
                            return '<span class="badge bg-orange-lt">Dañado</span>';
                        case 'Mantenimiento':
                            return '<span class="badge bg-yellow-lt">Mantenimiento</span>';
                        case 'Desaparecido':
                            return '<span class="badge bg-gray-lt">Desaparecido</span>';
                        case 'Descartado':
                            return '<span class="badge bg-black text-white">Descartado</span>';
                        default:
                            return '<span class="badge bg-secondary">Desconocido</span>';
                    }
                })

                ->editColumn('nombre', function ($row) {
                    return $row->bien->nombre ?? 'S/D';
                })
                ->editColumn('categoria', function ($row) {
                    // dd($row->bien->categoria->nombre);
                    return $row->bien->categoria->nombre ?? 'S/D';
                })
                ->editColumn('unidad_medida', function ($row) {
                    return $row->bien->unidad_medida ?? 'S/D';
                })
                ->editColumn('codigo_inventario', function ($row) {
                    return $row->codigo_inventario ?? 'S/D';
                })
                ->addColumn('actions', 'bienes.actionsInventario')


                ->rawColumns(['actions', 'estado'])
                ->make(true);
        } else {
            $entes = Ente::pluck('nombre', 'id');
            return view('bienes.inventario')->with('entes', $entes);
        }
    }

    public function editInventario($id)
    {

        $bien = BienAsignado::with('bien', 'movimientos')->find($id);
        $movimientos = HistorialMovimiento::where('codigo_inventario', $bien->codigo_inventario)->orderBy('id', 'DESC')->get();
        $movimiento = Movimiento::find($bien->movimiento_id);
        //dd($bien, $movimiento);
        //  dd($bien);
        return view('bienes.editInventario', compact('bien', 'movimiento', 'movimientos'));
    }

    public function actualizarBienAsignado(Request $request, $id)
    {
        $bien = BienAsignado::find($id);
        $movimiento = Movimiento::where('id', $bien->movimiento_id)->first();

        //Actualizar Historial
        $estado = $request->estado;
        if ($estado == 'Dañado') {
            HistorialMovimiento::create([
                'ente_destino_id' => $movimiento->ente_destino_id,
                'departamento_destino_id' => $movimiento->departamento_destino_id,
                'ente_origen_id' => $movimiento->ente_origen_id,
                'departamento_origen_id' => $movimiento->departamento_origen_id,
                'bien_id' => $bien->bien_id,
                'bien_asignado_id' => $bien->id,
                'codigo_inventario' => $bien->codigo_inventario,
                'tipo' => 'DAÑADO',
            ]);
        } elseif ($estado == 'Mantenimiento') {
            HistorialMovimiento::create([
                'ente_destino_id' => $movimiento->ente_destino_id,
                'departamento_destino_id' => $movimiento->departamento_destino_id,
                'ente_origen_id' => $movimiento->ente_origen_id,
                'departamento_origen_id' => $movimiento->departamento_origen_id,
                'bien_id' => $bien->bien_id,
                'bien_asignado_id' => $bien->id,
                'codigo_inventario' => $bien->codigo_inventario,
                'tipo' => 'MANTENIMIENTO',
            ]);
        } elseif ($estado == 'Activo') {
            HistorialMovimiento::create([
                'ente_destino_id' => $movimiento->ente_destino_id,
                'departamento_destino_id' => $movimiento->departamento_destino_id,
                'ente_origen_id' => $movimiento->ente_origen_id,
                'departamento_origen_id' => $movimiento->departamento_origen_id,
                'bien_id' => $bien->bien_id,
                'bien_asignado_id' => $bien->id,
                'codigo_inventario' => $bien->codigo_inventario,
                'tipo' => 'REACTIVACIÓN',
            ]);
        } elseif ($estado == 'Inactivo') {
            HistorialMovimiento::create([
                'ente_destino_id' => $movimiento->ente_destino_id,
                'departamento_destino_id' => $movimiento->departamento_destino_id,
                'ente_origen_id' => $movimiento->ente_origen_id,
                'departamento_origen_id' => $movimiento->departamento_origen_id,
                'bien_id' => $bien->bien_id,
                'bien_asignado_id' => $bien->id,
                'codigo_inventario' => $bien->codigo_inventario,
                'tipo' => 'INACTIVIDAD',
            ]);
        } elseif ($estado == 'Descartado') {
            HistorialMovimiento::create([
                'ente_destino_id' => $movimiento->ente_destino_id,
                'departamento_destino_id' => $movimiento->departamento_destino_id,
                'ente_origen_id' => $movimiento->ente_origen_id,
                'departamento_origen_id' => $movimiento->departamento_origen_id,
                'bien_id' => $bien->bien_id,
                'bien_asignado_id' => $bien->id,
                'codigo_inventario' => $bien->codigo_inventario,
                'tipo' => 'DESCARTADO',
            ]);
        } elseif ($estado == 'Desaparecido') {
            HistorialMovimiento::create([
                'ente_destino_id' => $movimiento->ente_destino_id,
                'departamento_destino_id' => $movimiento->departamento_destino_id,
                'ente_origen_id' => $movimiento->ente_origen_id,
                'departamento_origen_id' => $movimiento->departamento_origen_id,
                'bien_id' => $bien->bien_id,
                'bien_asignado_id' => $bien->id,
                'codigo_inventario' => $bien->codigo_inventario,
                'tipo' => 'DESAPARECIDO',
            ]);
        } elseif ($bien->estado == 'Inactivo') {
            Alert::error('¡Error!', 'Este bien esta inactivo, no puede pasarse a un estatus de rango superior.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->back();
        }

        //Actualizar status

        $bien->estado = $estado;
        $bien->save();

        Alert::success('¡Exito!', 'Bien actualizado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('bienes.inventario')->with('success', 'Movimiento creado correctamente.');
    }


    public function destroyBienAsignado($id)
    {
        $bien = BienAsignado::find($id);

        $historial = HistorialMovimiento::where('codigo_inventario', $bien->codigo_inventario)->get();

        foreach ($historial as $h) {
            $h->delete();
        }
        $bien->delete();
        Alert::success('¡Exito!', 'Bien eliminado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');
        return redirect()->route('bienes.inventario')->with('success', 'Movimiento creado correctamente.');
    }

    public function exportBienesPorDepartamento(Request $request)
    {
        $enteId = $request->ente_id;
        $departamentoId = $request->departamento_destino_id;

        return Excel::download(new BienesPorDepartamentoExport($enteId, $departamentoId), 'bienes_por_departamento.xlsx');
    }

}
