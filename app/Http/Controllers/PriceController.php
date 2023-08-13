<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    private $_price;

    public function __construct(Price $price)
    {
        $this->_price = $price;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.price.index',[
            'title' => 'Pricing',
            'prices' => Price::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PriceRequest $request)
    {
        $data = [
            ...$request->all(), 
            'is_featured' => ($request['is_featured'] === "true") ? true : false
        ];

        $createData = Price::create($data);
        if ($createData) {
            return response()->json([
                'message'   => 'Harga Created Successfully',
                'data'      => $createData
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        return response()->json([
            'data' => $price
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, Price $price)
    {
        $data = $price->update([
            ...$request->all(),
            'is_featured' => ($request->is_featured == "true") ? true : false
        ]);

        if ($data) {
            return response()->json([
                'message' => 'update'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        $data = $price->delete();
        if ($data) {
            return response()->json([
                'message' => 'Deleted'
            ]);
        }
        return response()->json([
            'message' => 'Data Not Found',
            'code' => 404
        ]);
    }
}
