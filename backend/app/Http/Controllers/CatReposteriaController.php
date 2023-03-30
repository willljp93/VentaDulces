<?php

namespace App\Http\Controllers;

use App\Models\catReposteria;
use App\Http\Requests\StorecatReposteriaRequest;
use App\Http\Requests\UpdatecatReposteriaRequest;

class CatReposteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catReposterias = catReposteria::all();
        $array = [];
        foreach ($catReposterias as $catReposteria) {
            $array[] = [
                'id' => $catReposteria->id,
                'title' => $catReposteria->title,
                'description' => $catReposteria->description,
                'image' => $catReposteria->image,
                'price' => $catReposteria->price,
                'available' => $catReposteria->available,
                'rating' => $catReposteria->rating,
                'discount' => $catReposteria->discount,
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
    public function store(StorecatReposteriaRequest $request)
    {
        $catReposteria = new catReposteria;
        $catReposteria->title = $request->title;
        $catReposteria->description = $request->description;
        $catReposteria->image = $request->image;
        $catReposteria->price = $request->price;
        $catReposteria->available = $request->available;
        $catReposteria->rating = $request->rating;
        $catReposteria->discount = $request->discount;
        $catReposteria->save();
        $data = [
            'menssage' => 'Item creado satifactoriamente',
            'data' => $catReposteria
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(catReposteria $catReposteria)
    {
        $data = [
            'message' => 'Detalles de Item',
            'data' => $catReposteria,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(catReposteria $catReposteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecatReposteriaRequest $request, catReposteria $catReposteria)
    {
        $catReposteria->title = $request->title;
        $catReposteria->description = $request->description;
        $catReposteria->image = $request->image;
        $catReposteria->price = $request->price;
        $catReposteria->available = $request->available;
        $catReposteria->rating = $request->rating;
        $catReposteria->discount = $request->discount;
        $catReposteria->save();
        $data = [
            'menssage' => 'Item actualizado correctamente',
            'client' => $catReposteria
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(catReposteria $catReposteria)
    {
        $catReposteria->delete();
        $data = [
            'menssage' => 'Item eliminado correctamente',
            'client' => $catReposteria
        ];
        return response()->json($data);
    }
}