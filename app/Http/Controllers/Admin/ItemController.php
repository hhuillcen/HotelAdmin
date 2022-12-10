<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Models\Categorie;
use App\Models\Item;
use App\Models\Movie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('type')) {
            $items = Item::where('type', $request->type)
                ->where(function ($query) use ($request) {
                    $query->whereRaw('UNACCENT(UPPER(name)) iLIKE UNACCENT(UPPER(?))', '%' . $request->get('query') . '%')
                        ->orWhereRaw('UNACCENT(UPPER(description)) iLIKE UNACCENT(UPPER(?))', '%' . $request->get('query') . '%');
                })
                ->paginate(12);
            if ($request->get('type') == 'food') {
                return response()->view('admin.items.index-food', compact('items'));
            } elseif ($request->get('type') == 'drink') {
                return response()->view('admin.items.index-drink', compact('items'));
            } elseif ($request->get('type') == 'movie') {
                $items->appends(['type' => 'movie']);
                return response()->view('admin.items.index-movie', compact('items'));
            }
        } else {
            $items = Item::all();
        }
        return response()->view('admin.items.index-food', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return response()->view('admin.items.create-food');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItemRequest $request
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $request)
    {
        // dump($request->validated());
        $validated = $request->validated();
        if ($request->has('type')) {
            if ($request->get('type') == 'food') {
                $item = new Item();
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->type = 'food';
                if ($request->hasFile('image')) {
                    $item->image = $request->file('image')->store('public');
                }
                $item->save();
                return redirect()->route('admin.items.index', ['type' => $item->type])->with('status', 'creado con éxito');
            }
        } else {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('public');
            }
            $item = Item::create($validated);
            return redirect()->route('admin.items.index', ['type' => $item->type])->with('status', 'creado con éxito');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Item $item)
    {
        return response()->view('admin.items.edit-food', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item $item
     * @return RedirectResponse
     */
    public function update(Request $request, Item $item)
    {
        /* $validated = $request->validated();*/
        if ($request->has('type')) {
            if ($request->get('type') == 'food') {
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->type = 'food';
                if ($request->hasFile('image')) {
                    if ($item->image != '') {
                        Storage::delete($item->image);
                    }
                    $item->image = $request->file('image')->store('public');
                }
                $item->save();
                return back()->with('status', 'Editado con éxito');
            } elseif ($request->get('type') == 'movie') {

                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->type = 'movie';
                if ($request->hasFile('image')) {
                    if ($item->image != '') {
                        Storage::delete($item->image);
                    }
                    $item->image = $request->file('image')->store('public');
                }
                $item->save();

                $item->movie->trailer = $request->trailer;

                $item->movie->save();

                $item->movie->categories()->detach();

                foreach ($request->category_id as $category) {
                    $category = Categorie::find($category);
                    $item->movie->categories()->attach($category);
                }
                $item->save();
                return back()->with('status', 'Editado con éxito');
            }
        } else {
            if ($request->hasFile('image')) {
                if ($item->image != '') {
                    Storage::delete($item->image);
                }
                $item->image = $request->file('image')->store('public');
            }
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->type = $request->type;
            $item->save();
            return back()->with('status', 'Editado con éxito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Item $item
     * @return RedirectResponse
     */
    public function destroy(Item $item)
    {
        if ($item->delete()) {
            return back()->with('status', 'Eliminado con éxito');
        }
        return back()->withErrors('status', 'No se pudo eliminar');
    }
}
