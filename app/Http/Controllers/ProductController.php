<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostAndPutRequestValidate;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Product[]
     */
    public function index(): array
    {
        return Product::all();
    }

    public function getAllProductsWithNameOrCategory(string $searchText){
        return Product::getAllWithNameOrCategory($searchText)->get();
    }

    public function getAllProductsWithSpecificCategory(string $searchText){
        return Product::getAllWithSpecificCategory($searchText)->get();
    }

    public function getAllProductsWithImage()
    {
        return Product::getAllWithImage()->get();
    }

    public function getAllProductsWithoutImage()
    {
        return Product::getAllWithoutImage()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductPostAndPutRequestValidate $request
     * @return Product|null
     */
    public function store(ProductPostAndPutRequestValidate $request): ?Product
    {
        return Product::createNewProduct($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Product|null
     */
    public function show(int $id): ?Product
    {
        return Product::query()->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductPostAndPutRequestValidate $request
     * @param Product $product
     * @return bool
     */
    public function update(ProductPostAndPutRequestValidate $request, Product $product): bool
    {
        return $product->updateProduct($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     * @throws \Throwable
     */
    public function destroy(int $id): bool
    {
        $product = Product::query()->find($id);

        return $product ? $product->deleteOrFail() : false;
    }
}
