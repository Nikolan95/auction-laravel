<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();

//        foreach ($products as $product){
//            dd($product->highestBidUser());
//        }

        return view('admin.dashboard', [
            'products' => $products
        ]);
    }
    public function store(StoreProductRequest $request)
    {
        if(isset($request->validator) && $request->validator->fails()){
            return response()->json(['status' => 0, 'error' => $request->validator->errors()->toArray()]);
        }
        $product = Product::create($request->validated());

        if($request->image){
            $zip = new \ZipArchive();

            if ($zip->open($request->image) === TRUE) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    $zip->extractTo('images/products');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => 'images/products/'.$filename
                    ]);
                }
            }
        }
        return new ProductResource($product);
    }
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }
    public function update(StoreProductRequest $request)
    {
        if(isset($request->validator) && $request->validator->fails()){
            return response()->json(['status' => 0, 'error' => $request->validator->errors()->toArray()]);
        }
        $product = Product::findOrFail($request->input('id'));
        $product->update($request->validated());
        return new ProductResource($product);
    }
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        $product->delete();
        return response()->noContent();
    }
}
