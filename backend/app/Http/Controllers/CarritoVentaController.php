<?php

namespace App\Http\Controllers;

use App\Models\CarritoVenta;
use App\Http\Requests\StoreCarritoVentaRequest;
use App\Http\Requests\UpdateCarritoVentaRequest;
use Illuminate\Http\Request;

class CarritoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carritoVenta = CarritoVenta::all();
        $array = [];
        foreach ($carritoVenta as $carritoventa) {
            $array[] = [
                'id' => $carritoventa->id,
                'idusers' => $carritoventa->idusers,
                'title' => $carritoventa->title,
                'description' => $carritoventa->description,
                'image' => $carritoventa->image,
                'price' => $carritoventa->price,
                'discount' => $carritoventa->discount,
                'finalprice' => $carritoventa->finalprice,
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
    public function store(StoreCarritoVentaRequest $request)
    {
        $carritoVenta = new CarritoVenta;
        $carritoVenta->idusers = $request->idusers;
        $carritoVenta->title = $request->title;
        $carritoVenta->description = $request->description;
        $carritoVenta->image = $request->image;
        $carritoVenta->price = $request->price;
        $carritoVenta->discount = $request->discount;
        $carritoVenta->finalprice = $request->finalprice;
        $carritoVenta->save();
        $data = [
            'menssage' => 'Item creado satifactoriamente',
            'data' => $carritoVenta
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarritoVenta $idusers)
    {
        $carritoVenta = CarritoVenta::findOrFail($idusers);
        return response()->json($carritoVenta);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarritoVenta $carritoVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarritoVentaRequest $request, CarritoVenta $carritoVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarritoVenta $carritoVenta)
    {
        $carritoVenta->delete();
        $data = [
            'menssage' => 'Item eliminado correctamente',
            'client' => $carritoVenta
        ];
        return response()->json($data);
    }

    public function vaciarCarrito(Request $request)
    {
        $userid = $request->idusers;
        CarritoVenta::where('idusers', $userid)->delete();
        return response()->json(['message' => 'Carrito vaciado con éxito'], 200);
    }

    public function showiduser(Request $request)
    {
        $registros = CarritoVenta::where('idusers', $request->idusers)->get();
        //return response()->json(['registros' => $registros], 200);

        return $registros;
    }
}
