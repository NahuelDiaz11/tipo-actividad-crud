<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoActividadRequest;
use App\Http\Requests\UpdateTipoActividadRequest;
use App\Models\TipoActividad;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TipoActividadController extends Controller
{
    /**
     * Listado de tipos de actividades (solo activas)
     */
    public function index()
    {
        return Inertia::render('ActividadesLaborales/Index', [
            'actividades' => TipoActividad::orderBy('orden_adicional')
                ->orderBy('descripcion')
                ->get()
        ]);
    }

    /**
     * Alta de tipo de actividad
     */
    public function store(StoreTipoActividadRequest $request)
    {
        TipoActividad::create([
            'descripcion' => $request->descripcion,
            'orden_adicional' => $request->orden_adicional,
            'user_upd' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Tipo de actividad creada correctamente.');
    }

    /**
     * Modificación
     */
    public function update(UpdateTipoActividadRequest $request, TipoActividad $tipoActividad)
    {
        $tipoActividad->update([
            'descripcion' => $request->descripcion,
            'orden_adicional' => $request->orden_adicional,
            'user_upd' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Tipo de actividad actualizada correctamente.');
    }

    /**
     * Baja lógica
     */
    public function destroy(TipoActividad $tipoActividad)
    {
        $tipoActividad->delete();

        return redirect()
            ->back()
            ->with('success', 'Tipo de actividad eliminada correctamente.');
    }
}
