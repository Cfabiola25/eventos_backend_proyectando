<?php

namespace App\Http\Controllers\Web\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalLocations = Location::count();
        $activeLocations = Location::where('is_active', 1)->count();
        $inactiveLocations = Location::where('is_active', 0)->count();
        $locations = Location::orderBy('created_at', 'desc')->paginate(10);
        $search = '';

        return view('Locations.index', compact('locations', 'totalLocations', 'activeLocations', 'inactiveLocations', 'search'));
    }

    /**
     * Búsqueda AJAX de ubicaciones
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $query = Location::orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('country', 'LIKE', "%{$search}%")
                    ->orWhere('room', 'LIKE', "%{$search}%");
            });
        }

        $locations = $query->paginate(10);
        $totalLocations = Location::count();
        $activeLocations = Location::where('is_active', 1)->count();
        $inactiveLocations = Location::where('is_active', 0)->count();
        $html = view('Locations.components.table', compact('locations'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $locations->total(),
            'search' => $search,
            'stats' => [
                'total' => $totalLocations,
                'active' => $activeLocations,
                'inactive' => $inactiveLocations
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'room' => 'nullable|string|max:255',
                'reference_point' => 'nullable|string|max:500',
                'latitude' => 'nullable|string|max:255',
                'longitude' => 'nullable|string|max:255',
                'google_maps_link' => 'nullable|url|max:500',
                'country' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'is_active' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $validated['uuid'] = Str::uuid();

            // Manejar imagen usando el disco 'local'
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'locations/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

                // Guardar en disco local
                Storage::disk('local')->put($imageName, file_get_contents($image->getRealPath()));
                $validated['image'] = $imageName;
            }

            $validated['is_active'] = $validated['is_active'] ?? 1;
            Location::create($validated);

            return redirect()->route('Locations.index')->with('success', 'Ubicación creada correctamente');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear la ubicación: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $location = Location::where('uuid', $uuid)->firstOrFail();
            return view('Locations.edit', compact('location'));

        } catch (\Exception $e) {
            return redirect()->route('Locations.index')->with('error', 'Ubicación no encontrada');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $location = Location::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'room' => 'nullable|string|max:255',
                'reference_point' => 'nullable|string|max:500',
                'latitude' => 'nullable|string|max:255',
                'longitude' => 'nullable|string|max:255',
                'google_maps_link' => 'nullable|url|max:500',
                'country' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'is_active' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            // Manejar imagen usando el disco 'local'
            if ($request->hasFile('image')) {
                // Obtener la ruta de la imagen actual
                $oldImagePath = $location->getRawOriginal('image');

                // Eliminar imagen anterior si existe
                if ($oldImagePath && Storage::disk('local')->exists($oldImagePath)) {
                    Storage::disk('local')->delete($oldImagePath);
                }

                // Guardar nueva imagen
                $image = $request->file('image');
                $imageName = 'locations/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

                Storage::disk('local')->put($imageName, file_get_contents($image->getRealPath()));
                $validated['image'] = $imageName;
            }

            $validated['is_active'] = $validated['is_active'] ?? 0;
            $location->update($validated);

            return redirect()->route('Locations.index')->with('success', 'Ubicación actualizada correctamente');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar la ubicación: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $location = Location::where('uuid', $uuid)->firstOrFail();

            // Obtener la ruta de la imagen actual (sin procesar por el accessor)
            $imagePath = $location->getRawOriginal('image');

            // Eliminar imagen si existe
            if ($imagePath && Storage::disk('local')->exists($imagePath)) {
                Storage::disk('local')->delete($imagePath);
            }

            $location->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ubicación eliminada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la ubicación: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle active status
     */
    public function toggleStatus($uuid)
    {
        try {
            $location = Location::where('uuid', $uuid)->firstOrFail();
            $location->is_active = !$location->is_active;
            $location->save();

            // Recalcular estadísticas
            $totalLocations = Location::count();
            $activeLocations = Location::where('is_active', true)->count();
            $inactiveLocations = Location::where('is_active', false)->count();

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente',
                'is_active' => $location->is_active,
                'stats' => [
                    'total' => $totalLocations,
                    'active' => $activeLocations,
                    'inactive' => $inactiveLocations
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}