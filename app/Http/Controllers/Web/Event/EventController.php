<?php

namespace App\Http\Controllers\Web\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Modality;
use App\Models\Category;
use App\Models\Program;
use App\Models\Theme;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\Location;
use App\Models\EventSpeaker;
use App\Models\EventTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with(['modality', 'categories', 'tags', 'programs', 'themes', 'speakers', 'locations', 'schedules'])
                      ->latest()
                      ->paginate(10);

        $totalEvents = Event::count();
        $activeEvents = Event::where('is_active', true)->count();
        $inactiveEvents = Event::where('is_active', false)->count();
        $virtualEvents = Event::whereHas('modality', function($query) {
            $query->where('name', 'like', '%virtual%');
        })->count();

        return view('event.index', compact(
            'events', 
            'totalEvents', 
            'activeEvents', 
            'inactiveEvents', 
            'virtualEvents'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modalities = Modality::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        $tags = Tag::all();
        $programs = Program::where('is_active', true)->get();
        $themes = Theme::where('is_active', true)->get();
        $speakers = Speaker::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();
        $schedules = Schedule::all();

        return view('event.create', compact(
            'modalities',
            'categories',
            'tags',
            'programs',
            'themes',
            'speakers',
            'locations',
            'schedules'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'modality_id' => 'required|exists:modalitys,id',
            'max_capacity' => 'nullable|integer|min:1',
            'virtual_link' => 'nullable|url',
            'color' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            
            // Arrays para relaciones
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'programs' => 'nullable|array',
            'programs.*' => 'exists:programs,id',
            'themes' => 'nullable|array',
            'themes.*' => 'exists:themes,id',
            'speakers' => 'nullable|array',
            'speakers.*' => 'exists:speakers,id',
            'schedules' => 'nullable|array',
            'schedules.*' => 'exists:schedules,id',
            'locations' => 'nullable|array',
            'locations.*' => 'exists:locations,id',
        ]);

        try {
            // Generar UUID
            $validated['uuid'] = (string) Str::uuid();

            // Manejar la imagen
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
                $validated['image'] = $imagePath;
            }

            // Crear el evento
            $event = Event::create($validated);

            // Sincronizar relaciones
            if ($request->has('categories')) {
                $event->categories()->sync($request->categories);
            }

            if ($request->has('tags')) {
                $event->tags()->sync($request->tags);
            }

            if ($request->has('programs')) {
                $event->programs()->sync($request->programs);
            }

            if ($request->has('themes')) {
                $event->themes()->sync($request->themes);
            }

            if ($request->has('speakers')) {
                $event->speakers()->sync($request->speakers);
            }

            // Manejar relación muchos a muchos con ubicaciones y horarios
            if ($request->has('schedules') && $request->has('locations')) {
                $scheduleLocations = [];
                foreach ($request->schedules as $index => $scheduleId) {
                    if (isset($request->locations[$index])) {
                        $scheduleLocations[$scheduleId] = ['location_id' => $request->locations[$index]];
                    }
                }
                $event->schedules()->sync($scheduleLocations);
            }

            return redirect()->route('events.index')
                           ->with('success', 'Evento creado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error al crear el evento: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        try {
            $event = Event::with([
                'modality',
                'categories',
                'tags',
                'programs',
                'themes',
                'speakers',
                'locations',
                'schedules'
            ])->where('uuid', $uuid)->firstOrFail();

            // Si es petición AJAX (para el modal), retornar JSON
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'event' => $event
                ]);
            }

            // Si no es AJAX, retornar la vista completa
            return view('event.show', compact('event'));
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Evento no encontrado'
                ], 404);
            }

            return redirect()->route('events.index')->with('error', 'Evento no encontrado');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid) // Cambiar a $uuid
     {
            $event = Event::where('uuid', $uuid)
                        ->with(['categories', 'tags', 'programs', 'themes', 'speakers', 'schedules', 'locations'])
                        ->firstOrFail();

            $modalities = Modality::where('is_active', true)->get();
            $categories = Category::where('is_active', true)->get();
            $tags = Tag::all();
            $programs = Program::where('is_active', true)->get();
            $themes = Theme::where('is_active', true)->get();
            $speakers = Speaker::where('is_active', true)->get();
            $locations = Location::where('is_active', true)->get();
            $schedules = Schedule::all();

            return view('event.edit', compact(
                'event',
                'modalities',
                'categories',
                'tags',
                'programs',
                'themes',
                'speakers',
                'locations',
                'schedules'
            ));
     }


     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        Log::info('====== INICIO UPDATE EVENTO ======');
        Log::info('UUID: ' . $uuid);
        Log::info('Datos recibidos:', $request->except(['_token', '_method']));
        
        try {
            $event = Event::where('uuid', $uuid)->firstOrFail();
            Log::info('Evento encontrado:', ['id' => $event->id, 'title' => $event->title]);

            $validated = $request->validate([
                'title' => 'required|string|max:200',
                'description' => 'nullable|string',
                'modality_id' => 'required|exists:modalitys,id',
                'max_capacity' => 'nullable|integer|min:1',
                'virtual_link' => 'nullable|url',
                'color' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'is_active' => 'nullable|boolean',
                
                'categories' => 'nullable|array',
                'categories.*' => 'exists:categories,id',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:tags,id',
                'programs' => 'nullable|array',
                'programs.*' => 'exists:programs,id',
                'themes' => 'nullable|array',
                'themes.*' => 'exists:themes,id',
                'speakers' => 'nullable|array',
                'speakers.*' => 'exists:speakers,id',
                'schedules' => 'nullable|array',
                'schedules.*' => 'exists:schedules,id',
                'locations' => 'nullable|array',
                'locations.*' => 'exists:locations,id',
            ]);

            Log::info('Datos validados:', $validated);

            // Manejar la imagen
            if ($request->hasFile('image')) {
                $oldImage = $event->getRawOriginal('image');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                    Log::info('Imagen anterior eliminada:', ['path' => $oldImage]);
                }
                
                $imagePath = $request->file('image')->store('events', 'public');
                $validated['image'] = $imagePath;
                Log::info('Nueva imagen guardada:', ['path' => $imagePath]);
            }

            $validated['is_active'] = filter_var($request->is_active);
            Log::info('is_active convertido:', ['value' => $validated['is_active']]);

            // Actualizar el evento
            $event->update($validated);
            $event->refresh();
            Log::info('Evento actualizado correctamente');

            // Cateorias - Usando el mismo enfoque que speakers
            $newCategories = $request->input('categories', []);
            Log::info('Categories del formulario:', ['new' => $newCategories]);

            $categoriesToSync = [];
            foreach ($newCategories as $categoryId) {
                $categoriesToSync[$categoryId] = [
                    'uuid' => (string) Str::uuid(),
                    'event_id' => $event->id,
                    'category_id' => $categoryId
                ];
            }
            $event->categories()->sync($categoriesToSync);
            Log::info('Categories sincronizados con sync():', ['final' => array_keys($categoriesToSync)]);
            
            // TAGS: Usando el mismo enfoque que speakers
            $newTags = $request->input('tags', []);
            Log::info('Tags del formulario:', ['new' => $newTags]);
            
            $tagsToSync = [];
            foreach ($newTags as $tagId) {
                $tagsToSync[$tagId] = [
                    'uuid' => (string) Str::uuid(),
                    'event_id' => $event->id,
                    'tag_id' => $tagId
                ];
            }
            $event->tags()->sync($tagsToSync);
            Log::info('Tags sincronizados con sync():', ['final' => array_keys($tagsToSync)]);
            
            // PROGRAMS: Usando el mismo enfoque que speakers
            $newPrograms = $request->input('programs', []);
            Log::info('Programs del formulario:', ['new' => $newPrograms]); 

            $programsToSync = [];
            foreach ($newPrograms as $programId) {
                $programsToSync[$programId] = [
                    'uuid' => (string) Str::uuid(),
                    'event_id' => $event->id,
                    'program_id' => $programId
                ];
            }
            $event->programs()->sync($programsToSync);
            Log::info('Programs sincronizados con sync():', ['final' => array_keys($programsToSync)]);

            $newThemes = $request->input('themes', []);
            Log::info('Themes del formulario:', ['new' => $newThemes]);

            $themesToSync = [];
            foreach ($newThemes as $themeId) {
                $themesToSync[$themeId] = [
                    'uuid' => (string) Str::uuid(),
                    'event_id' => $event->id,
                    'theme_id' => $themeId
                ];
            }
            $event->themes()->sync($themesToSync);
            Log::info('Themes sincronizados con sync():', ['final' => array_keys($themesToSync)]);
            
            EventSpeaker::where('event_id', $event->id)->delete(); // ← ESTO ELIMINA TODOS LOS REGISTROS ANTIGUOS
            Log::info('Relaciones de speakers antiguas eliminadas');
            
            // En su lugar, usa este código MÁS SIMPLE Y EFICIENTE:
            $newSpeakers = $request->input('speakers', []);
            Log::info('Speakers del formulario:', ['new' => $newSpeakers]);
            
            // Speakers: Usando el mismo enfoque que categories y tags
            $speakersToSync = [];
            foreach ($newSpeakers as $speakerId) {
                $speakersToSync[$speakerId] = [
                    'uuid' => (string) Str::uuid(),
                    'event_id' => $event->id,
                    'speaker_id' => $speakerId
                ];
            }
            $event->speakers()->sync($speakersToSync);
            Log::info('Speakers sincronizados con sync():', ['final' => array_keys($speakersToSync)]);
            
            $finalSpeakers = EventSpeaker::where('event_id', $event->id)
                ->pluck('speaker_id')
                ->toArray();
            Log::info('Speakers finales:', ['final' => $finalSpeakers]);

            // Manejar relación muchos a muchos con ubicaciones y horarios
            if ($request->has('schedules') && $request->has('locations')) {
                $scheduleLocations = [];
                foreach ($request->schedules as $index => $scheduleId) {
                    if (isset($request->locations[$index])) {
                        $scheduleLocations[$scheduleId] = ['location_id' => $request->locations[$index]];
                    }
                }
                $event->schedules()->sync($scheduleLocations);
                Log::info('Schedules/Locations sincronizados');
            } else {
                $event->schedules()->sync([]);
            }

            Log::info('====== FIN UPDATE EXITOSO ======');

            return redirect()->route('events.index')
                        ->with('success', 'Evento actualizado exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación:', ['errors' => $e->errors()]);
            return redirect()->back()->withInput()->withErrors($e->validator);
                        
        } catch (\Exception $e) {
            Log::error('====== ERROR EN UPDATE ======');
            Log::error('Mensaje: ' . $e->getMessage());
            Log::error('Línea: ' . $e->getLine());
            Log::error('Archivo: ' . $e->getFile());
            
            return redirect()->back()
                        ->with('error', 'Error al actualizar el evento: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid) // Cambiar a $uuid
    {
        try {
            $event = Event::where('uuid', $uuid)->firstOrFail();

            // Eliminar imagen si existe
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Evento eliminado exitosamente.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el evento: ' . $e->getMessage()
            ], 500);
        }
    }

    
    /**
     * Toggle event status
     */
    public function toggleStatus($uuid) // Cambiar {event} por {uuid}
    {
        try {
            $event = Event::where('uuid', $uuid)->firstOrFail();
            
            $event->update([
                'is_active' => !$event->is_active
            ]);

            $totalEvents = Event::count();
            $activeEvents = Event::where('is_active', true)->count();
            $inactiveEvents = Event::where('is_active', false)->count();
            $virtualEvents = Event::whereHas('modality', function($query) {
                $query->where('name', 'like', '%virtual%');
            })->count();

            return response()->json([
                'success' => true,
                'message' => 'Estado del evento actualizado exitosamente.',
                'stats' => [
                    'total' => $totalEvents,
                    'active' => $activeEvents,
                    'inactive' => $inactiveEvents,
                    'virtual' => $virtualEvents
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search events
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $page = $request->get('page', 1);

        $events = Event::with(['modality', 'categories', 'tags', 'programs'])
                      ->when($search, function($query) use ($search) {
                          $query->where('title', 'like', "%{$search}%")
                                ->orWhere('description', 'like', "%{$search}%")
                                ->orWhereHas('modality', function($q) use ($search) {
                                    $q->where('name', 'like', "%{$search}%");
                                })
                                ->orWhereHas('categories', function($q) use ($search) {
                                    $q->where('name', 'like', "%{$search}%");
                                });
                      })
                      ->latest()
                      ->paginate(10, ['*'], 'page', $page);

        $totalEvents = Event::count();
        $activeEvents = Event::where('is_active', true)->count();
        $inactiveEvents = Event::where('is_active', false)->count();
        $virtualEvents = Event::whereHas('modality', function($query) {
            $query->where('name', 'like', '%virtual%');
        })->count();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('event.components.table', compact('events'))->render(),
                'stats' => [
                    'total' => $totalEvents,
                    'active' => $activeEvents,
                    'inactive' => $inactiveEvents,
                    'virtual' => $virtualEvents
                ]
            ]);
        }

        return view('event.index', compact(
            'events', 
            'totalEvents', 
            'activeEvents', 
            'inactiveEvents', 
            'virtualEvents'
        ));
    }
}