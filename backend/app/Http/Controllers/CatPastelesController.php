<?php

namespace App\Http\Controllers;

use App\Models\catPasteles;
use App\Http\Requests\StorecatPastelesRequest;
use App\Http\Requests\UpdatecatPastelesRequest;

class CatPastelesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catPasteless = catPasteles::all();
        $array = [];
        foreach ($catPasteless as $catPasteles) {
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
    public function store(StorecatPastelesRequest $request)
    {
        $catPasteles = new catPasteles;
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
    public function show(catPasteles $catPasteles)
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
    public function edit(catPasteles $catPasteles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecatPastelesRequest $request, catPasteles $catPasteles)
    {
        $catPasteles->title = $request->title;
        $catPasteles->description = $request->description;
        $catPasteles->image = $request->image;
        $catPasteles->price = $request->price;
        $catPasteles->available = $request->available;
        $catPasteles->rating = $request->rating;
        $catPasteles->discount = $request->discount;
        $catPasteles->save();
        $data = [
            'menssage' => 'Item actualizado correctamente',
            'client' => $catPasteles
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(catPasteles $catPasteles)
    {
        $catPasteles->delete();
        $data = [
            'menssage' => 'Item eliminado correctamente',
            'client' => $catPasteles
        ];
        return response()->json($data);
    }
}