<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return response($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategory $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = Category::create($request->only('name'));
        return response()->json(['msg' => 'Category Added', 'data' => $category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategory $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateCategory $request, Category $category)
    {
        $category->update($request->only('name'));
        return response()->json(['msg' => 'Category Updated', 'data' => $category], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['msg' => 'Category Deleted'], 201);
    }
}
