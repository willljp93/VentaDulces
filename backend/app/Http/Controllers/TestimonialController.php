<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        $array = [];
        foreach ($testimonials as $Testimonial) {
            $array[] = [
                'id' => $Testimonial->id,
                'avatar' => $Testimonial->avatar,
                'name' => $Testimonial->name,
                'text' => $Testimonial->text,
                'rating' => $Testimonial->rating
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
    public function store(StoreTestimonialRequest $request)
    {
        $testimonials = new Testimonial;
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
    public function show(Testimonial $testimonial)
    {
        $data = [
            'message' => 'Detalles de testimonials',
            'client' => $testimonial,
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->avatar = $request->avatar;
        $testimonial->name = $request->name;
        $testimonial->text = $request->text;
        $testimonial->rating = $request->rating;
        $testimonial->save();
        $data = [
            'menssage' => 'Featured actualizado correctamente',
            'client' => $testimonial
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        $data = [
            'menssage' => 'Featured eliminado correctamente',
            'client' => $testimonial
        ];
        return response()->json($data);
    }
}
