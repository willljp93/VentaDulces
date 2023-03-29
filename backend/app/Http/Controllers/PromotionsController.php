<?php

namespace App\Http\Controllers;

use App\Models\promotions;
use App\Http\Requests\StorepromotionsRequest;
use App\Http\Requests\UpdatepromotionsRequest;

class PromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotionss = promotions::all();
        //create object to store data
        $array = [];
        foreach ($promotionss as $promotions) {
            $array[] = [
                'id' => $promotions->id,
                'title' => $promotions->title,
                'description' => $promotions->description,
                'discount' => $promotions->discount,
                'expires' => $promotions->expires,
                'image' => $promotions->image
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
    public function store(StorepromotionsRequest $request)
    {
        $promotions = new promotions;
        $promotions->title = $request->title;
        $promotions->description = $request->description;
        $promotions->discount = $request->discount;
        $promotions->expires = $request->expires;
        $promotions->image = $request->image;
        $promotions->save();
        $data = [
            'menssage' => 'promotions creado satifactoriamente',
            'client' => $promotions
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(promotions $promotions)
    {
        $data = [
            'message' => 'Detalles de promotions',
            'client' => $promotions,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(promotions $promotions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepromotionsRequest $request, promotions $promotions)
    {
        $promotions->title = $request->title;
        $promotions->description = $request->description;
        $promotions->discount = $request->discount;
        $promotions->expires = $request->expires;
        $promotions->image = $request->image;
        $promotions->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $promotions
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(promotions $promotions)
    {
        $promotions->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $promotions
        ];
        return response()->json($data);
    }
}
