<?php

namespace App\Http\Controllers;

use App\Models\CatPanaderia;
use App\Http\Requests\StoreCatPanaderiaRequest;
use App\Http\Requests\UpdateCatPanaderiaRequest;

class CatPanaderiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catPanaderias = catPanaderia::all();
        $array = [];
        foreach ($catPanaderias as $catPanaderia) {
            $array[] = [
                'id' => $catPanaderia->id,
                'title' => $catPanaderia->title,
                'description' => $catPanaderia->description,
                'image' => $catPanaderia->image,
                'price' => $catPanaderia->price,
                'available' => $catPanaderia->available,
                'rating' => $catPanaderia->rating,
                'discount' => $catPanaderia->discount,
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
    public function store(StoreCatPanaderiaRequest $request)
    {
        $catPanaderia = new catPanaderia;
        $catPanaderia->title = $request->title;
        $catPanaderia->description = $request->description;
        $catPanaderia->image = $request->image;
        $catPanaderia->price = $request->price;
        $catPanaderia->available = $request->available;
        $catPanaderia->rating = $request->rating;
        $catPanaderia->discount = $request->discount;
        $catPanaderia->save();
        $data = [
            'menssage' => 'Item creado satifactoriamente',
            'data' => $catPanaderia
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(CatPanaderia $catPanaderia)
    {
        $data = [
            'message' => 'Detalles de Item',
            'data' => $catPanaderia,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatPanaderia $catPanaderia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatPanaderiaRequest $request, CatPanaderia $catPanaderia)
    {
        $catPanaderia->title = $request->title;
        $catPanaderia->description = $request->description;
        $catPanaderia->image = $request->image;
        $catPanaderia->price = $request->price;
        $catPanaderia->available = $request->available;
        $catPanaderia->rating = $request->rating;
        $catPanaderia->discount = $request->discount;
        $catPanaderia->save();
        $data = [
            'menssage' => 'Item actualizado correctamente',
            'client' => $catPanaderia
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatPanaderia $catPanaderia)
    {
        $catPanaderia->delete();
        $data = [
            'menssage' => 'Item eliminado correctamente',
            'client' => $catPanaderia
        ];
        return response()->json($data);
    }
}
