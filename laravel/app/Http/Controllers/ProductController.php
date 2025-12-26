<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts() {
        return Product::all();
    }

    public function createProduct(Request $request) {
        abort_unless(auth()->user()->can('products.create'), 403, 'Unauthorized');
        $product = Product::create($request->all());
        return $product;
    }

    public function getProduct($productId) {
        return Product::findOrFail($productId);
    }

    public function updateProduct(Request $request, $productId) {
        abort_unless(auth()->user()->can('products.update'), 403, 'Unauthorized');
        $product = Product::findOrFail($productId);
        $product->update($request->all());
        return $product;
    }

    public function deleteProduct($productId) {
        $product = Product::findOrFail($productId);
        $product->delete();
        return ["message" => "Product deleted successfully"];
    }

    public function getProductsByCategory($categoryId) {
        return Product::where('category_id', $categoryId)->get();
    }
}
