<?php

namespace App\Http\Controllers;

use App\Model\ReceivedProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReceivedProductRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ReceivedProduct\ReceivedProductResource;

class ReceivedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReceivedProductResource::collection(ReceivedProduct::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceivedProductRequest $request)
    {
        $receivedProduct = new ReceivedProduct;
        $receivedProduct->product_id = $request->product_id;
        $receivedProduct->total_amount = $request->total_amount;
        $receivedProduct->save();

        $product = Product::where('id', $request->product_id)->firstOrFail();
        $product->increment('stock', $request->total_amount);

        return response([
            'data' => new ReceivedProductResource($receivedProduct)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ReceivedProduct  $receivedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ReceivedProduct $receivedProduct)
    {
        return new ReceivedProductResource($receivedProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ReceivedProduct  $receivedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceivedProduct $receivedProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ReceivedProduct  $receivedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceivedProduct $receivedProduct)
    {
        $receivedProduct->update($request->all());
        return response([
            'data' => new ReceivedProductResource($receivedProduct)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ReceivedProduct  $receivedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceivedProduct $receivedProduct)
    {
        $receivedProduct->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
