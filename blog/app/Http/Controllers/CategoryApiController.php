<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // GET /api/categories
    public function index()
    {
        return Category::all();
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $name = $request->name;
        if(!$name) return response("name required", 400);

        $category = new Category;
        $category->name = $name;
        $category->save();

        return $category;
    }
    // GET /api/categories/{id}
    public function show(Category $category)
    {
        return $category;
    }

    // PUT /api/categories/{id}
    public function update(Request $request, Category $category)
    {
        $name = $request->name;
        if(!$name) return response("name required", 400);

        $category->name = $name;
        $category->save();

        return $category;
    }

    // DELETE /api/categories/{id}
    public function destroy(Category $category)
    {
        $category->delete();
        return $category;
    }
}
