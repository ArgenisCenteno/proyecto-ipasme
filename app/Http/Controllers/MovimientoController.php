<?php

namespace App\Http\Controllers;

use App\Exports\EntradasPorFechaExport;
use App\Exports\SalidasPorFechaExport;
use App\Models\BienAsignado;
use App\Models\BienMovimiento;
use App\Models\Departamento;
use App\Models\Ente;
use App\Models\HistorialMovimiento;
use App\Models\Movimiento;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Alert;
class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productos = Movimiento::with('departamentoDestino', 'proveedor')->where('tipo', 'ENTRADA')->get(); // Cargar la relación subCategoria
            // dd($productos);
            return DataTables::of($productos)

                ->addColumn('actions', 'movimientos.actions')
                ->editColumn('fecha', function ($row) {
                    return $row->fecha->format('d/m/Y');
                })
                ->editColumn('departamentoDestino', function ($row) {
                    return $row->departamentoDestino->nombre ?? 'No asignado';
                })
                ->rawColumns(['actions'])
                ->make(true);
        } else {
            $entes = Ente::first();
             $departamentos = Departamento::where('nombre', 'ALMACEN')->get();
            return view('movimientos.entradas')->with('entes', $entes)->with('departamentos', $departamentos);
        }
    }
    public function create()
    {
        $proveedores = Proveedor::pluck('razon_social', 'id');
        $entes = Ente::first();
        $departamentos = Departamento::where('nombre', 'ALMACEN')->get();

        return view('movimientos.create', compact('proveedores', 'entes', 'departamentos'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        //Validar los datos del formulario, factura unica, monto no negativo, todos los campos requeridos menos observaciones
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'ente_id' => 'required|exists:entes,id',
            'factura' => 'nullable|string|max:255|unique:movimientos,factura',
            'monto' => 'required|numeric|min:0',
            'observacion' => 'nullable|string|max:255',
        ]);

        //Los productos son obligatorios

        if (!$request->productos_json) {
            Alert::error('No seleccionó los bienes', 'Se deben seleccionar al menos un bien.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->back()->withErrors(['productos' => 'Se deben seleccionar al menos un producto.']);
        }

        $bienes = json_decode($request->productos_json, true);
        if (count($bienes) == 0) {
            Alert::error('No selecciono los bienes', 'Se deben seleccionar al menos un bien.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->back()->withErrors(['productos' => 'Se deben seleccionar al menos un producto.']);
        }
        //Registrar el movimiento
        $movimiento = Movimiento::create([
            'proveedor_id' => $request->proveedor_id,
            'ente_destino_id' => $request->ente_id,
            'tipo' => 'ENTRADA',
            'monto' => $request->monto,
            'fecha' => $request->fecha,
            'departamento_destino_id' => $request->departamento_destino_id,
            'observaciones' => $request->observacion,
            'factura' => $request->factura,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->user()->id,
        ]);

        //Registrar los bienes del movimiento

        foreach ($bienes as $bien) {
            // Registrar el bien en el movimiento
            $bien_movimiento = BienMovimiento::create([
                'bien_id' => $bien['id'],
                'movimiento_id' => $movimiento->id,
                'cantidad' => $bien['cantidad'],
            ]);

            // Crear registros individuales de BienAsignado
            for ($i = 0; $i < $bien['cantidad']; $i++) {
                $codigo_inventario = 'INV-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 6)) . '-' . time();
            //    dd($bien);
                $asignacion = BienAsignado::create([
                    'departamento_id' => $request->departamento_destino_id,
                    'ente_id' => $request->ente_id,
                    'bien_id' => $bien['id'],
                    'movimiento_id' => $movimiento->id,
                    'cantidad' => 1,
                    'estado' => 'Activo', // puedes usar un estado por defecto como "activo"
                    'fecha_adquisicion' => $request->fecha, // o date('Y-m-d') si no viene en el request
                    'codigo_inventario' => $codigo_inventario,
                    'serial' => $bien['serial'] ?? null, // Si el serial es opcional
                ]);

                HistorialMovimiento::create([
                    'ente_destino_id' => $request->ente_id,
                    'departamento_destino_id' => $request->departamento_destino_id,
                    'bien_id' => $bien['id'],
                    'bien_asignado_id' => $asignacion->id,
                    'tipo' => 'ENTRADA',
                    'codigo_inventario' => $asignacion->codigo_inventario,
                ]);
            }
        }


        Alert::success('¡Exito!', 'Movimiento registrado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('movimientos.index')->with('success', 'Movimiento creado correctamente.');
    }

    public function edit($id)
    {
        // Aquí puedes cargar los datos necesarios para la vista de edición
        $movimiento = Movimiento::find($id);
          $proveedores = Proveedor::pluck('razon_social', 'id');
        $entes = Ente::first();
        $departamentos = Departamento::where('nombre', 'ALMACEN')->get();

        return view('movimientos.edit', compact('movimiento', 'departamentos', 'entes', 'proveedores'));
    }
    public function editSalida($id)
    {
        // Aquí puedes cargar los datos necesarios para la vista de edición
        $movimiento = Movimiento::find($id);
          $proveedores = Proveedor::pluck('razon_social', 'id');
        $entes = Ente::first();
        $departamentos = Departamento::where('nombre', 'ALMACEN')->get();

        return view('movimientos.editSalida', compact('movimiento', 'departamentos', 'entes', 'proveedores'));
    }
   public function update(Request $request, $id)
{
    $movimiento = Movimiento::findOrFail($id);

    $request->validate([
        'proveedor_id' => 'required|exists:proveedores,id',
        'departamento_destino_id' => 'required|exists:departamentos,id',
        'fecha' => 'required|date',
        'factura' => 'nullable|string|max:255|unique:movimientos,factura,' . $id,
        'descripcion' => 'required|string',
        'observacion' => 'nullable|string|max:255',
        'cantidades' => 'required|array',
    ]);

    $movimiento->update([
        'proveedor_id' => $request->proveedor_id,
        'departamento_destino_id' => $request->departamento_destino_id,
        'fecha' => $request->fecha,
        'factura' => $request->factura,
        'descripcion' => $request->descripcion,
        'observaciones' => $request->observacion,
    ]);

   foreach ($request->cantidades as $bienMovimientoId => $nuevaCantidad) {
    $bienMovimiento = BienMovimiento::find($bienMovimientoId);
    
    if ($bienMovimiento && $bienMovimiento->movimiento_id == $movimiento->id) {
        $cantidadAnterior = $bienMovimiento->cantidad;
        $bienMovimiento->cantidad = $nuevaCantidad;
        $bienMovimiento->save();

        // Diferencia de cantidad
        $diferencia = $nuevaCantidad - $cantidadAnterior;
       
        if ($diferencia > 0) {
            // Crear nuevas asignaciones
            for ($i = 0; $i < $diferencia; $i++) {
                $codigo_inventario = 'INV-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 6)) . '-' . time();
                
                $asignacion = BienAsignado::create([
                    'departamento_id' => $movimiento->departamento_destino_id,
                    'ente_id' => $movimiento->ente_destino_id,
                    'bien_id' => $bienMovimiento->bien_id,
                    'movimiento_id' => $movimiento->id,
                    'cantidad' => 1,
                    'estado' => 'Activo',
                    'fecha_adquisicion' => $movimiento->fecha,
                    'codigo_inventario' => $codigo_inventario,
                    'serial' => null,
                ]);

                HistorialMovimiento::create([
                    'ente_destino_id' => $movimiento->ente_destino_id,
                    'departamento_destino_id' => $movimiento->departamento_destino_id,
                    'bien_id' => $bienMovimiento->bien_id,
                    'bien_asignado_id' => $asignacion->id,
                    'tipo' => 'ENTRADA',
                    'codigo_inventario' => $asignacion->codigo_inventario,
                ]);
            }
        } elseif ($diferencia < 0) {
            // Buscar asignaciones activas para este movimiento y bien
            $asignaciones = BienAsignado::where('movimiento_id', $movimiento->id)
                ->where('bien_id', $bienMovimiento->bien_id)
                ->where('estado', 'Activo')
                ->limit(abs($diferencia))
                ->get();
       
            foreach ($asignaciones as $asignacion) {
  
                $asignacion->delete();
                
            }
        }
    }
}


    Alert::success('¡Actualizado!', 'Movimiento actualizado correctamente')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');
    return redirect()->route('movimientos.index');
}


    public function destroy($id)
    {
        $movimiento = Movimiento::find($id);
        if (!$movimiento) {
            Alert::error('¡Error!', 'Movimiento no encontrado')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->route('movimientos.index')->with('error', 'Movimiento no encontrado.');
        }
        //Eliminar asignaciones de bienes
        $bienes_asignados = BienAsignado::where('movimiento_id', $movimiento->id)->get();
        foreach ($bienes_asignados as $bien_asignado) {
            $bien_asignado->delete();
        }

        //Eliminar detalles del movimiento
        $bienes_movimiento = BienMovimiento::where('movimiento_id', $movimiento->id)->get();
        foreach ($bienes_movimiento as $bien_movimiento) {
            $bien_movimiento->delete();
        }

        //Eliminar el movimiento
        $movimiento->delete();
        Alert::success('¡Exito!', 'Movimiento eliminado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');
        return redirect()->back()->with('success', 'Movimiento eliminado correctamente.');
    }

    public function show($id)
    {
        // Aquí puedes manejar la lógica para mostrar un movimiento específico
        $movimiento = Movimiento::where('id', $id)->with('proveedor', 'enteDestino', 'departamentoDestino')->first();
        //dd($movimiento);
        if (!$movimiento) {
            Alert::error('¡Error!', 'Movimiento no encontrado')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->route('movimientos.index')->with('error', 'Movimiento no encontrado.');
        }

        $bienes = BienMovimiento::where('movimiento_id', $movimiento->id)->with('bien')->paginate(5);
        ;
        return view('movimientos.showEntrada', compact('movimiento', 'bienes'));
    }


    public function showSalida($id)
    {
        // Aquí puedes manejar la lógica para mostrar un movimiento específico
        $movimiento = Movimiento::where('id', $id)->with('enteOrigen', 'enteDestino', 'departamentoDestino', 'departamentoOrigen')->first();
        //dd($movimiento);
        if (!$movimiento) {
            Alert::error('¡Error!', 'Movimiento no encontrado')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->route('salidas.index')->with('error', 'Movimiento no encontrado.');
        }

        $bienes = BienMovimiento::where('movimiento_id', $movimiento->id)->with('bien')->paginate(5);
        ;
        return view('movimientos.showSalida', compact('movimiento', 'bienes'));
    }
    public function salidas(Request $request)
    {
        if ($request->ajax()) {
            $productos = Movimiento::with('departamentoDestino', 'proveedor', 'departamentoOrigen')->where('tipo', '=', 'SALIDA')->get(); // Cargar la relación subCategoria
            // dd($productos);
            return DataTables::of($productos)

                ->addColumn('actions', 'movimientos.actionsSalidas')
                ->editColumn('fecha', function ($row) {
                    return $row->fecha->format('d/m/Y');
                })
                ->editColumn('departamentoDestino', function ($row) {
                    return $row->departamentoDestino->nombre ?? 'No asignado';
                })
                ->editColumn('departamentoOrigen', function ($row) {
                    return $row->departamentoOrigen->nombre ?? 'No asignado';
                })
                ->editColumn('enteDestino', function ($row) {
                    return $row->enteDestino->nombre ?? 'No asignado';
                })
                ->editColumn('enteOrigen', function ($row) {
                    return $row->enteOrigen->nombre ?? 'No asignado';
                })
                ->rawColumns(['actions'])
                ->make(true);
        } else {
             $entes = Ente::first();
             $departamentos = Departamento::where('nombre', 'ALMACEN')->get();
            return view('movimientos.salidas')->with('entes', $entes)->with('departamentos', $departamentos);
        }


    }

    public function createSalida(Request $request)
    {

        $entes = Ente::first();

        return view('movimientos.createSalida', compact('entes'));
    }

    public function storeSalida(Request $request)
    {
        //  dd($request->all());
        $request->validate([

            'ente_destino_id' => 'required|exists:entes,id',
            'ente_origen_id' => 'required|exists:entes,id',
            'departamento_destino_id' => 'required|exists:departamentos,id',
            'departamento_origen_id' => 'required|exists:departamentos,id',
            'factura' => 'nullable|string|max:255|unique:movimientos,factura',
            'monto' => 'required|numeric|min:0',
            'observacion' => 'nullable|string|max:255',
        ]);

        //Los productos son obligatorios

        if (!$request->productos_json) {
            Alert::error('No seleccionó los bienes', 'Se deben seleccionar al menos un bien.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->back()->withErrors(['productos' => 'Se deben seleccionar al menos un producto.']);
        }

        if ($request->departamento_origen_id == $request->departamento_destino_id) {
            Alert::error('Error', 'No se puede crear una salida dentro de un mismo departamento.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->back()->withErrors(['productos' => 'No se puede crear una salida dentro de un mismo departamento.']);
        }

        $bienes = json_decode($request->productos_json, true);
        if (count($bienes) == 0) {
            Alert::error('No selecciono los bienes', 'Se deben seleccionar al menos un bien.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

            return redirect()->back()->withErrors(['productos' => 'Se deben seleccionar al menos un producto.']);
        }
        //Registrar el movimiento
        $movimiento = Movimiento::create([

            'ente_destino_id' => $request->ente_destino_id,
            'ente_origen_id' => $request->ente_origen_id,
            'tipo' => 'SALIDA',
            'monto' => $request->monto,
            'fecha' => $request->fecha,
            'departamento_destino_id' => $request->departamento_destino_id,
            'departamento_origen_id' => $request->departamento_origen_id,
            'observaciones' => $request->observacion,
            'factura' => $request->factura,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->user()->id,
        ]);

        //Registrar los bienes del movimiento
        foreach ($bienes as $bien) {

            $bienMov = BienAsignado::find($bien['id']);
            //   dd($bienMov, $bien['id']);
            // dd($bienMov, $bien['id']);
            // Registrar el bien en el movimiento
            //  dd($bienMov);
            $bien_movimiento = BienMovimiento::create([
                'bien_id' => $bienMov->bien_id,
                'movimiento_id' => $movimiento->id,
                'cantidad' => $bien['cantidad'],
            ]);


            if ($bienMov) {
                // Cambiar el estado del bien asignado actual a Inactivo
                $bienMov->update([
                    'estado' => 'Inactivo'
                ]);
            }

            // Crear una nueva asignación activa para el nuevo departamento y ente
            $asignacion = BienAsignado::create([
                'departamento_id' => $request->departamento_destino_id,
                'ente_id' => $request->ente_destino_id,
                'bien_id' => $bienMov->bien_id,
                'movimiento_id' => $movimiento->id,
                'cantidad' => 1,
                'estado' => 'Activo',
                'fecha_adquisicion' => $request->fecha,
                'codigo_inventario' => $bienMov->codigo_inventario

            ]);

            HistorialMovimiento::create([
                'ente_destino_id' => $request->ente_destino_id,
                'departamento_destino_id' => $request->departamento_destino_id,
                'ente_origen_id' => $request->ente_origen_id,
                'departamento_origen_id' => $request->departamento_origen_id,
                'bien_id' => $bienMov->bien_id,
                'bien_asignado_id' => $asignacion->id,
                'codigo_inventario' => $bienMov->codigo_inventario,
                'tipo' => 'SALIDA',
            ]);
        }


        Alert::success('¡Exito!', 'Movimiento registrado correctamente.')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');

        return redirect()->route('salidas.index')->with('success', 'Movimiento creado correctamente.');
    }

    public function exportEntradasPorFecha(Request $request)
    {
        $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde',
        ]);
        // dd($request);
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $ente = $request->input('ente_id');
        $departamento = $request->input('departamento_destino_id');
        return Excel::download(new EntradasPorFechaExport($desde, $hasta, $ente, $departamento), 'entradas_por_fecha.xlsx');
    }

    public function exportSalidasPorFecha(Request $request)
    {
        $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde',
        ]);
        // dd($request);
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $ente = $request->input('ente_id');
        $departamento = $request->input('departamento_destino_id');
        return Excel::download(new SalidasPorFechaExport($desde, $hasta, $ente, $departamento), 'entradas_por_fecha.xlsx');
    }

    public function updateSalida(Request $request, $id)
{
    $movimiento = Movimiento::findOrFail($id);

    $request->validate([
        'ente_destino_id' => 'required|exists:entes,id',
        'ente_origen_id' => 'required|exists:entes,id',
        'departamento_destino_id' => 'required|exists:departamentos,id',
        'departamento_origen_id' => 'required|exists:departamentos,id',
        'factura' => 'nullable|string|max:255|unique:movimientos,factura,' . $id,
        'monto' => 'required|numeric|min:0',
        'descripcion' => 'required|string',
        'observacion' => 'nullable|string|max:255',
        'fecha' => 'required|date',
        'cantidades' => 'required|array',
    ]);

    // Actualiza los campos generales
    $movimiento->update([
        'ente_destino_id' => $request->ente_destino_id,
        'ente_origen_id' => $request->ente_origen_id,
        'departamento_destino_id' => $request->departamento_destino_id,
        'departamento_origen_id' => $request->departamento_origen_id,
        'factura' => $request->factura,
        'monto' => $request->monto,
        'descripcion' => $request->descripcion,
        'observaciones' => $request->observacion,
        'fecha' => $request->fecha,
    ]);

    foreach ($request->cantidades as $bienMovimientoId => $nuevaCantidad) {
        $bienMovimiento = \App\Models\BienMovimiento::find($bienMovimientoId);

        if ($bienMovimiento && $bienMovimiento->movimiento_id == $movimiento->id) {
            $cantidadAnterior = $bienMovimiento->cantidad;
            $bienMovimiento->update(['cantidad' => $nuevaCantidad]);

            $bien_id = $bienMovimiento->bien_id;

            if ($nuevaCantidad > $cantidadAnterior) {
                // Asignar nuevos bienes (crear BienAsignado y Historial)
                $asignacionesInactivas = BienAsignado::where('bien_id', $bien_id)
                    ->where('movimiento_id', $movimiento->id)
                    ->where('estado', 'Inactivo')
                    ->limit($nuevaCantidad - $cantidadAnterior)
                    ->get();

                foreach ($asignacionesInactivas as $asignacion) {
                    $asignacion->estado = 'Activo';
                    $asignacion->save();

                    HistorialMovimiento::create([
                        'ente_destino_id' => $request->ente_destino_id,
                        'departamento_destino_id' => $request->departamento_destino_id,
                        'ente_origen_id' => $request->ente_origen_id,
                        'departamento_origen_id' => $request->departamento_origen_id,
                        'bien_id' => $bien_id,
                        'bien_asignado_id' => $asignacion->id,
                        'codigo_inventario' => $asignacion->codigo_inventario,
                        'tipo' => 'SALIDA',
                    ]);
                }
            } elseif ($nuevaCantidad < $cantidadAnterior) {
                // Revertir asignaciones
                $asignaciones = BienAsignado::where('bien_id', $bien_id)
                    ->where('movimiento_id', $movimiento->id)
                    ->where('estado', 'Activo')
                    ->latest()
                    ->limit($cantidadAnterior - $nuevaCantidad)
                    ->get();

                foreach ($asignaciones as $asignacion) {
                    $asignacion->estado = 'Revertido';
                    $asignacion->save();
                }
            }
        }
    }

    Alert::success('¡Actualizado!', 'Salida actualizada correctamente')->showConfirmButton('Aceptar', 'rgb(5, 141, 79)');
    return redirect()->route('salidas.index');
}

}
