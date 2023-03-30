<?php

namespace App\Http\Controllers;

use App\Models\catFlanes;
use App\Http\Requests\StorecatFlanesRequest;
use App\Http\Requests\UpdatecatFlanesRequest;

class CatFlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catFlaness = catFlanes::all();
        $array = [];
        foreach ($catFlaness as $catFlanes) {
            $array[] = [
                'id' => $catFlanes->id,
                'title' => $catFlanes->title,
                'description' => $catFlanes->description,
                'image' => $catFlanes->image,
                'price' => $catFlanes->price,
                'available' => $catFlanes->available,
                'rating' => $catFlanes->rating,
                'discount' => $catFlanes->discount,
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
    public function store(StorecatFlanesRequest $request)
    {
        $catFlanes = new catFlanes;
        $catFlanes->title = $request->title;
        $catFlanes->description = $request->description;
        $catFlanes->image = $request->image;
        $catFlanes->price = $request->price;
        $catFlanes->available = $request->available;
        $catFlanes->rating = $request->rating;
        $catFlanes->discount = $request->discount;
        $catFlanes->save();
        $data = [
            'menssage' => 'catFlanes creado satifactoriamente',
            'data' => $catFlanes
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(catFlanes $catFlanes)
    {
        $data = [
            'message' => 'Detalles de catFlanes',
            'data' => $catFlanes,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(catFlanes $catFlanes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecatFlanesRequest $request, catFlanes $catFlanes)
    {
        $catFlanes->title = $request->title;
        $catFlanes->description = $request->description;
        $catFlanes->image = $request->image;
        $catFlanes->price = $request->price;
        $catFlanes->available = $request->available;
        $catFlanes->rating = $request->rating;
        $catFlanes->discount = $request->discount;
        $catFlanes->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $catFlanes
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(catFlanes $catFlanes)
    {
        $catFlanes->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $catFlanes
        ];
        return response()->json($data);
    }
}
