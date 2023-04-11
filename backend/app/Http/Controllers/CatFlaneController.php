<?php

namespace App\Http\Controllers;

use App\Models\CatFlane;
use App\Http\Requests\StoreCatFlaneRequest;
use App\Http\Requests\UpdateCatFlaneRequest;

class CatFlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $CatFlanes = CatFlane::all();
        $array = [];
        foreach ($CatFlanes as $catFlanes) {
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
    public function store(StoreCatFlaneRequest $request)
    {
        $catFlanes = new catFlane;
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
    public function show(CatFlane $catFlane)
    {
        $data = [
            'message' => 'Detalles de catFlanes',
            'data' => $catFlane,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatFlane $catFlane)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatFlaneRequest $request, CatFlane $catFlane)
    {
        $catFlane->title = $request->title;
        $catFlane->description = $request->description;
        $catFlane->image = $request->image;
        $catFlane->price = $request->price;
        $catFlane->available = $request->available;
        $catFlane->rating = $request->rating;
        $catFlane->discount = $request->discount;
        $catFlane->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $catFlane
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatFlane $catFlane)
    {
        $catFlane->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $catFlane
        ];
        return response()->json($data);
    }
}
