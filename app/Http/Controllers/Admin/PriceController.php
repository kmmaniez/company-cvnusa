<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Models\Price;

class PriceController extends Controller
{

    public function index()
    {
        return view('admin.price.index', [
            'title'     => 'Pricing',
            'prices'    => Price::all()
        ]);
    }

    public function store(PriceRequest $request)
    {
        $data = [
            ...$request->all(),
            'is_featured' => ($request['is_featured'] === "true") ? true : false
        ];

        $createData = Price::create($data);
        if ($createData) {
            return $this->successResponse([],'created');
        }
    }

    public function show(Price $price)
    {
        return response()->json([
            'data' => $price
        ]);
    }

    public function update(PriceRequest $request, Price $price)
    {
        $updateData = $price->update([
            ...$request->all(),
            'is_featured' => ($request->is_featured == "true") ? true : false
        ]);

        if ($updateData) {
            return $this->successResponse(null,'updated');
        }
    }

    public function destroy(Price $price)
    {
        $deleteData = $price->delete();
        if ($deleteData) {
            return $this->successResponse(null,'deleted');
        }
    }
}
