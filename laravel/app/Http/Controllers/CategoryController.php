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
        $category = Category::findOrFail($categoryId);
        
        $this->authorize('view', $category);

        return $category;    }

    public function updateCategory(Request $request, $categoryId) {
        $category = Category::findOrFail($categoryId);
        $category->update($request->all());
        return $category;
    }

    public function updateStatus(Request $request, $categoryId) {
        $category = Category::findOrFail($categoryId);

        $this->authorize('updateStatus', $category);

        $category->update(['status' => $request->status]);
        return $category;
    }

    public function deleteCategory($categoryId) {
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return ["message" => "Category deleted successfully"];
    }
}
