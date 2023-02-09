<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Classes\DandH;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\HttpResponses;

class ProductController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreProductRequest $request)
    {

        $data = DandH::product('687P0UT');

        $request->validated($request->all());


        $product = Product::create([
            'itemId' => $data->salesItem->itemId,
            'price' => $data->salesItem->msrp,
            'vendorId' => $data->salesItem->vendorItemId,
            'vendorName' => $data->salesItem->vendorShortDescription,
            'description' => $data->salesItem->shortDescription,
            'imageUrl' => $request->image
        ]);

        return $this->success($product, 'Product successfully created', 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
