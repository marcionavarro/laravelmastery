<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->product->all();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     * @param Product $product
     * @param Request $request
     * @return Product
     */
    public function update(Product $product, Request $request)
    {
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return mixed
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $product->name;
    }
}
