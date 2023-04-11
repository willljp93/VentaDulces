<?php

namespace App\Http\Controllers;

use App\Models\CatDecoracione;
use App\Http\Requests\StoreCatDecoracioneRequest;
use App\Http\Requests\UpdateCatDecoracioneRequest;
use \Illuminate\Http\Response;

class CatDecoracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $catdecoraciones = catDecoraciones::all();
        // return response()->json($catdecoraciones);
        return response()->json(CatDecoracione::paginate(6));
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
    public function store(StoreCatDecoracioneRequest $request)
    {
        $catdecoraciones = CatDecoracione::create($request->all());
        return response()->json(
            data: ['catdecoraciones' => $catdecoraciones],
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(CatDecoracione $catDecoracione)
    {
        $data = [
            'message' => 'Detalles de Featureds',
            'client' => $catDecoracione,
        ];
        return response()->json($data);
        // return response()->json($catDecoraciones);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatDecoracione $catDecoracione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatDecoracioneRequest $request, CatDecoracione $catDecoracione)
    {
        $catDecoracione->update(attributes: $request->all());
        return response()->json(
            data: ['catdecoraciones' => $catDecoracione],
            status: Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatDecoracione $catDecoracione)
    {
        $catDecoracione->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $catDecoracione
        ];
        return response()->json($data);
    }
}
