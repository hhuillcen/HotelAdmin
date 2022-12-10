<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoomRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }
        $room = Room::create($validated);
        return redirect()->route('admin.rooms.index')->with('status', 'creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return response()->view('admin.rooms.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return response()->view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        if ($request->hasFile('image')) {
            if ($room->image != '') {
                Storage::delete($room->image);
            }
            $room->image = $request->file('image')->store('public');
        }
        $room->name = $request->name;
        $room->price = $request->price;
        $room->status = $request->status;
        $room->save();
        return back()->with('status', 'Editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Room $room)
    {
        if ($room->delete()) {
            return back()->with('status', 'Eliminado con exito');
        }
        return back()->withErrors('status', 'No se pudo eliminar');
    }
}
