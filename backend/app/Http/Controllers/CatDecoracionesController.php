<?php

namespace App\Http\Controllers;

use App\Models\catDecoraciones;
use App\Http\Requests\StorecatDecoracionesRequest;
use App\Http\Requests\UpdatecatDecoracionesRequest;
use \Illuminate\Http\Response;

class CatDecoracionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $catdecoraciones = catDecoraciones::all();
        // return response()->json($catdecoraciones);
        return response()->json(catdecoraciones::paginate(6));
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
    public function store(StorecatDecoracionesRequest $request)
    {
        $catdecoraciones = Catdecoraciones::create($request->all());
        return response()->json(
            data: ['catdecoraciones' => $catdecoraciones],
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(catDecoraciones $catDecoraciones)
    {
        $data = [
            'message' => 'Detalles de Featureds',
            'client' => $catDecoraciones,
        ];
        return response()->json($data);
        // return response()->json($catDecoraciones);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(catDecoraciones $catDecoraciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecatDecoracionesRequest $request, catDecoraciones $catDecoraciones)
    {
        $catDecoraciones->update(attributes: $request->all());
        return response()->json(
            data: ['catdecoraciones' => $catDecoraciones],
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(catDecoraciones $catDecoraciones)
    {
        $catDecoraciones->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $catDecoraciones
        ];
        return response()->json($data);
    }
}