<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetailRequest;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDetailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDetailRequest $request)
    {
        //Guardar el detalle
        $detail = Detail::create($request->all());
        return back()->with('status', 'El detalle se agregó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Detail $detail)
    {
        // delete
        if ($detail->delete()) {
            return back()->with('status', 'Eliminado con éxito');
        }
        return back()->withErrors('status', 'No se pudo eliminar');
    }
}
