<?php

namespace App\Http\Controllers\General;

use App\Models\Eloquent\General\Category\CategoryFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Category\CreateCategoryRequest;
use App\Http\Requests\General\Category\UpdateCategoryRequest;
use App\Http\Resources\General\Category\CategoryCollection;
use App\Http\Resources\General\Category\CategoryResource;
use App\Models\Eloquent\General\Category\Category;

class CategoryController extends Controller
{
    public function index(CategoryFilters $filter)
    {
        return new CategoryCollection(Category::filter($filter)->get());
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category($request->validated());
        $category->save();

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->validated());
        $category->update();

        return new CategoryResource($category);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return api()->noContent();
    }
}