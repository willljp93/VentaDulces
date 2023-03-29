<?php

namespace App\Http\Controllers;

use App\Models\testimonials;
use App\Http\Requests\StoretestimonialsRequest;
use App\Http\Requests\UpdatetestimonialsRequest;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonialss = testimonials::all();
        $array = [];
        foreach ($testimonialss as $testimonials) {
            $array[] = [
                'id' => $testimonials->id,
                'avatar' => $testimonials->avatar,
                'name' => $testimonials->name,
                'text' => $testimonials->text,
                'rating' => $testimonials->rating
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
    public function store(StoretestimonialsRequest $request)
    {
        $testimonials = new Testimonials;
        $testimonials->avatar = $request->avatar;
        $testimonials->name = $request->name;
        $testimonials->text = $request->text;
        $testimonials->rating = $request->rating;
        $testimonials->save();
        $data = [
            'menssage' => 'testimonials creado satifactoriamente',
            'client' => $testimonials
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(testimonials $testimonials)
    {
        $data = [
            'message' => 'Detalles de testimonials',
            'client' => $testimonials,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(testimonials $testimonials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetestimonialsRequest $request, testimonials $testimonials)
    {
        $testimonials->avatar = $request->avatar;
        $testimonials->name = $request->name;
        $testimonials->text = $request->text;
        $testimonials->rating = $request->rating;
        $testimonials->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $testimonials
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(testimonials $testimonials)
    {
        $testimonials->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $testimonials
        ];
        return response()->json($data);
    }
}
