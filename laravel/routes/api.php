<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    $token = $user->createToken('mobile')->accessToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:api')->group(function () {

    Route::get('/me', function (Request $r) {
        return $r->user()->load('roles');
    });


    Route::controller(CategoryController::class)->prefix('categories')->group(function() {
        Route::get('/', 'getCategories');                  
        Route::post('/', 'createCategory');                
        Route::get('/{categoryId}', 'getCategory');        
        Route::patch('/{categoryId}', 'updateCategory');   
        Route::delete('/{categoryId}', 'deleteCategory');  
        
        Route::patch('/{categoryId}/status',  'updateStatus');
        Route::get('/{categoryId}/products', [ProductController::class, 'getProductsByCategory']); 
    });

    // --- Product Routes ---
    Route::controller(ProductController::class)->prefix('products')->group(function() {
        Route::get('/', 'getProducts');                    
        Route::post('/', 'createProduct');                 
        Route::get('/{productId}', 'getProduct');         
        Route::patch('/{productId}', 'updateProduct');     
        Route::delete('/{productId}', 'deleteProduct');    
    });
});
