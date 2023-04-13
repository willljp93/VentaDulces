<?php

namespace App\Http\Controllers;

use App\Models\CatPastele;
use App\Http\Requests\StoreCatPasteleRequest;
use App\Http\Requests\UpdateCatPasteleRequest;

class CatPasteleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catPasteles = CatPastele::all();


        return response()->json($catPasteles);
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
    public function store(StoreCatPasteleRequest $request)
    {
        $catPasteles =  CatPastele::create($request->all());

        return response()->json(
            [
                'menssage' => 'Item creado satifactoriamente',
                'data' => $catPasteles
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(CatPastele $catPasteles)
    {
        $data = [
            'message' => 'Detalles de Item',
            'data' => $catPasteles,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatPastele $catPastele)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatPasteleRequest $request, CatPastele $catPastele)
    {
        $catPastele->title = $request->title;
        $catPastele->description = $request->description;
        $catPastele->image = $request->image;
        $catPastele->price = $request->price;
        $catPastele->available = $request->available;
        $catPastele->rating = $request->rating;
        $catPastele->discount = $request->discount;
        $catPastele->save();
        $data = [
            'menssage' => 'Item actualizado correctamente',
            'client' => $catPastele
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatPastele $catPastele)
    {
        $catPastele->delete();
        $data = [
            'menssage' => 'Item eliminado correctamente',
            'client' => $catPastele
        ];
        return response()->json($data);
    }
}
