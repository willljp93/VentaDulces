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
        $array = [];
        foreach ($catPasteles as $catPasteles) {
            $array[] = [
                'id' => $catPasteles->id,
                'title' => $catPasteles->title,
                'description' => $catPasteles->description,
                'image' => $catPasteles->image,
                'price' => $catPasteles->price,
                'available' => $catPasteles->available,
                'rating' => $catPasteles->rating,
                'discount' => $catPasteles->discount,
            ];
        }
        return response()->json($array);
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
        $catPasteles = new CatPastele;
        $catPasteles->title = $request->title;
        $catPasteles->description = $request->description;
        $catPasteles->image = $request->image;
        $catPasteles->price = $request->price;
        $catPasteles->available = $request->available;
        $catPasteles->rating = $request->rating;
        $catPasteles->discount = $request->discount;
        $catPasteles->save();
        $data = [
            'menssage' => 'Item creado satifactoriamente',
            'data' => $catPasteles
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(CatPastele $catPastele)
    {
        $data = [
            'message' => 'Detalles de Item',
            'data' => $catPastele,
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
