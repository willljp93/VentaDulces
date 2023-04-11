<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::all();
        $array = [];
        foreach ($promotions as $promotion) {
            $array[] = [
                'id' => $promotion->id,
                'title' => $promotion->title,
                'description' => $promotion->description,
                'discount' => $promotion->discount,
                'expires' => $promotion->expires,
                'image' => $promotion->image
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
    public function store(StorePromotionRequest $request)
    {
        $promotions = new Promotion;
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
    public function show(Promotion $promotion)
    {
        $data = [
            'message' => 'Detalles de promotions',
            'client' => $promotion,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $promotion->title = $request->title;
        $promotion->description = $request->description;
        $promotion->discount = $request->discount;
        $promotion->expires = $request->expires;
        $promotion->image = $request->image;
        $promotion->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $promotion
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $promotion
        ];
        return response()->json($data);
    }
}
