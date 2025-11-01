<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\album;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Str;

class aktifitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        $activities = Activity::with('album')->orderBy('date', 'asc')->get();
        return view('activity.index', compact('activities', 'albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'date'        => 'required|date',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'nullable|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
            'notes'       => 'nullable|array',
            'notes.*'     => 'nullable|string|max:255',
            'album_id'    => 'nullable|exists:albums,id',
        ]);

        Activity::create([
            'name'        => $request->name,
            'location'    => $request->location,
            'icon'        => $request->icon,
            'date'        => $request->date,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'description' => $request->description,
            'notes'       => $request->notes ? json_encode($request->notes) : null,
            'album_id'    => $request->album_id,
        ]);
        

        return redirect()->route('activity.index')->with('success', 'Acara berhasil dibuat');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'date'        => 'required|date',
            // 'start_time'  => 'required|date_format:H:i',
            // 'end_time'    => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
            'notes'       => 'nullable|array',
            'notes.*'     => 'nullable|string|max:255',
            'album_id'    => 'nullable|exists:albums,id',
        ]);

        $activity->update([
            'name'        => $request->name,
            'location'    => $request->location,
            'icon'        => $request->icon,
            'date'        => $request->date,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'description' => $request->description,
            'notes'       => $request->notes ? json_encode($request->notes) : null,
            'album_id'    => $request->album_id,
        ]);

        return redirect()->route('activity.index')->with('success', 'Acara berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Acara berhasil dihapus');
    }

    public function generateImage(Activity $activity)
    {
        $filename = Str::slug($activity->name) . '-' . time() . '.png';
        $path = storage_path('app/public/undangan/' . $filename);

        // Path ke node & npm di server lokal kamu — sesuaikan kalau pakai Windows
        Browsershot::url(route('activity.invitation', $activity->id))
            ->setNodeBinary('"C:\laragon\bin\nodejs\node-v18\node.exe"') // <- ganti ini sesuai path Node.js di komputermu
            ->setNpmBinary('"C:\laragon\bin\nodejs\node-v18\npm.cmd"')   // <- dan ini juga
            ->waitUntilNetworkIdle()
            ->windowSize(800, 1200)
            ->save($path);

        $url = asset('storage/undangan/' . $filename);
        return response()->json(['url' => $url]);
    }

    public function invitationView(Activity $activity)
    {
        return view('activity.invitation', compact('activity'));
    }
}
