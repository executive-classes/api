<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Classroom\Module\Module;
use App\Http\Resources\Classroom\Module\ModuleResource;
use App\Models\Eloquent\Classroom\Module\ModuleFilters;
use App\Http\Resources\Classroom\Module\ModuleCollection;
use App\Http\Requests\Classroom\Module\CreateModuleRequest;
use App\Http\Requests\Classroom\Module\UpdateModuleRequest;

class ModuleController extends Controller
{
    public function index(ModuleFilters $filter)
    {
        return new ModuleCollection(Module::filter($filter)->get());
    }

    public function store(CreateModuleRequest $request)
    {
        $module = new Module($request->validated());
        $module->save();

        return new ModuleResource($module);
    }

    public function show(Module $module)
    {
        return new ModuleResource($module);
    }

    public function update(UpdateModuleRequest $request, Module $module)
    {
        $module->fill($request->validated());
        $module->update();

        return new ModuleResource($module);
    }

    public function reactivate(Module $module)
    {
        $module->active = true;
        $module->update();

        return new ModuleResource($module);
    }

    public function cancel(Module $module)
    {
        $module->active = false;
        $module->update();

        return new ModuleResource($module);
    }
}