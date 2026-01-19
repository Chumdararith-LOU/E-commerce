<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
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

Route::prefix('lab')->group(function () {
    Route::post('/authors', [LabController::class, 'createAuthors']);
    Route::post('/articles', [LabController::class, 'createArticles']);
    Route::post('/audiences', [LabController::class, 'createAudienceUsers']);
    Route::post('/subscribe', [LabController::class, 'subscribeArticles']);
    Route::post('/comments', [LabController::class, 'createComments']);
    
    Route::get('/sao-articles', [LabController::class, 'getSaoArticles']);
    Route::get('/climate-audiences', [LabController::class, 'getClimateAudiences']);
    Route::get('/sok-audiences', [LabController::class, 'getSokAudiences']);
    Route::get('/samnang-comments', [LabController::class, 'getSamnangComments']);
    Route::get('/all-comments', [LabController::class, 'getAllCommentsWithTopic']);
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

    Route::controller(ProductController::class)->prefix('products')->group(function() {
        Route::get('/', 'getProducts');                    
        Route::post('/', 'createProduct');                 
        Route::get('/{productId}', 'getProduct');         
        Route::patch('/{productId}', 'updateProduct');     
        Route::delete('/{productId}', 'deleteProduct');    
    });
});
