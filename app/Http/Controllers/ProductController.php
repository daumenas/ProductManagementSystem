<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.jwt')->except(['show']);
    }

    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $category = Category::find($request->category_id);
        if(!$category)
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category with id ' . $request->category_id . ' cannot be found.'
            ], 400);
        }
        $product = new Product([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $product->category()->associate($category);
        $product->save();

        return new ProductResource($product);
    }
}
