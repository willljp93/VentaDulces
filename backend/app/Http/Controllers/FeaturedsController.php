<?php

namespace App\Http\Controllers;

use App\Models\featureds;
use App\Http\Requests\StorefeaturedsRequest;
use App\Http\Requests\UpdatefeaturedsRequest;

class FeaturedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $featuredss = featureds::all();
        //create object to store data
        $array = [];
        foreach ($featuredss as $featureds) {
            $array[] = [
                'id' => $featureds->id,
                'name' => $featureds->name,
                'description' => $featureds->description,
                'price' => $featureds->price,
                'rating' => $featureds->rating,
                'discount' => $featureds->discount,
                'image' => $featureds->image
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
    public function store(StorefeaturedsRequest $request)
    {
        $featureds = new Featureds;
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
    public function show(featureds $featureds)
    {
        $data = [
            'message' => 'Detalles de Featureds',
            'client' => $featureds,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(featureds $featureds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefeaturedsRequest $request, featureds $featureds)
    {
        $featureds->name = $request->name;
        $featureds->description = $request->description;
        $featureds->price = $request->price;
        $featureds->rating = $request->rating;
        $featureds->discount = $request->discount;
        $featureds->image = $request->image;
        $featureds->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $featureds
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(featureds $featureds)
    {
        // $id = $request->ID;
        // $a = Featureds::findorfail($id);
        // $a->delete();

        $featureds->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $featureds
        ];
        return response()->json($data);
    }
}
