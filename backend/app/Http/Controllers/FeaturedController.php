<?php

namespace App\Http\Controllers;

use App\Models\Featured;
use App\Http\Requests\StoreFeaturedRequest;
use App\Http\Requests\UpdateFeaturedRequest;

class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Featureds = featured::all();
        $array = [];
        foreach ($Featureds as $Featured) {
            $array[] = [
                'id' => $Featured->id,
                'name' => $Featured->name,
                'description' => $Featured->description,
                'price' => $Featured->price,
                'rating' => $Featured->rating,
                'discount' => $Featured->discount,
                'image' => $Featured->image
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
    public function store(StoreFeaturedRequest $request)
    {
        $featureds = new Featured;
        $featureds->name = $request->name;
        $featureds->description = $request->description;
        $featureds->price = $request->price;
        $featureds->rating = $request->rating;
        $featureds->discount = $request->discount;
        $featureds->image = $request->image;
        $featureds->save();
        $data = [
            'menssage' => 'Featureds creado satifactoriamente',
            'client' => $featureds
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Featured $featured)
    {
        $data = [
            'message' => 'Detalles de Featureds',
            'client' => $featured,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Featured $featured)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeaturedRequest $request, Featured $featured)
    {
        $featured->name = $request->name;
        $featured->description = $request->description;
        $featured->price = $request->price;
        $featured->rating = $request->rating;
        $featured->discount = $request->discount;
        $featured->image = $request->image;
        $featured->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $featured
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Featured $featured)
    {
        $featured->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $featured
        ];
        return response()->json($data);
    }
}
