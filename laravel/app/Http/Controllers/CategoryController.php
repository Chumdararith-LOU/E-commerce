<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories() {
        return Category::all();
    }

    public function createCategory(Request $request) {
        $category = Category::create($request->all());
        return $category;
    }

    public function getCategory($categoryId) {
        return Category::findOrFail($categoryId);
    }

    public function updateCategory(Request $request, $categoryId) {
        $category = Category::findOrFail($categoryId);
        $category->update($request->all());
        return $category;
    }

    public function deleteCategory($categoryId) {
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return ["message" => "Category deleted successfully"];
    }
}
