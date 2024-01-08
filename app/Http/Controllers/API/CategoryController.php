<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return response()->json($category, 201);
    }


    public function destroy($id)
{
    $categories = Category::find($id);
    $categories->delete();
    // if (!$categories) {
    //     return response()->json(['error' => 'Category not found.'], 404);
    // }

   

    return response()->json(['message' => 'Category deleted successfully.']);
}

}
