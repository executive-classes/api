<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Eloquent\Classroom\Material\MaterialFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\Material\CreateMaterialRequest;
use App\Http\Requests\Classroom\Material\UpdateMaterialRequest;
use App\Http\Resources\Classroom\Material\MaterialCollection;
use App\Http\Resources\Classroom\Material\MaterialResource;
use App\Models\Eloquent\Classroom\Material\Material;

class MaterialController extends Controller
{
    public function index(MaterialFilters $filter)
    {
        return new MaterialCollection(Material::filter($filter)->get());
    }

    public function store(CreateMaterialRequest $request)
    {
        $material = new Material($request->validated());
        $material->save();

        return new MaterialResource($material);
    }

    public function show(Material $material)
    {
        return new MaterialResource($material);
    }

    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->fill($request->validated());
        $material->update();

        return new MaterialResource($material);
    }

    public function reactivate(Material $material)
    {
        $material->active = true;
        $material->update();

        return new MaterialResource($material);
    }

    public function cancel(Material $material)
    {
        $material->active = false;
        $material->update();

        return new MaterialResource($material);
    }
}